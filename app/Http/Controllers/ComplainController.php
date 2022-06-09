<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Models\ComplainCategory;
use App\Models\Complainer;
use App\Models\ComplainSubCategory;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Mpdf\Mpdf;
use Mpdf\Config\FontVariables;
use Mpdf\Config\ConfigVariables;
use KhmerDateTime\KhmerDateTime;
use function PHPUnit\Framework\isNull;

class ComplainController extends Controller
{
    public function  exportComplatintReport(Request $request){
        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $mpdf = new \Mpdf\Mpdf(
            [
                'mode' => 'utf-8',
                'orientation' => 'L',
                'fontDir' => [
                    base_path('vendor/mpdf/mpdf/ttfonts'),
                    storage_path('Fonts'),
                ],
                'fontdata' => $fontData +  [
                    'KhmerOSmuollight' => [
                        'R' => 'KhmerOSmuollight.ttf',
                        'useOTL' => 255,
                    ]
                ]
            ]
        );
        $complaints = Complain::with(['complainer', 'department', 'department.faculty', 'complain_sub_category', 'complain_sub_category.complain_category'])->get();
        $html = \view('pdf',['complaints' => $complaints])->render();
        $mpdf->WriteHTML($html);
        return $mpdf->output('complaint report.pdf','I');
    }

    public function  exportComplatintReportBetweenDate(Request $request){
        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $mpdf = new \Mpdf\Mpdf(
            [
                'mode' => 'utf-8',
                'orientation' => 'L',
                'fontDir' => [
                    base_path('vendor/mpdf/mpdf/ttfonts'),
                    storage_path('Fonts'),
                ],
                'fontdata' => $fontData +  [
                        'KhmerOSmuollight' => [
                            'R' => 'KhmerOSmuollight.ttf',
                            'useOTL' => 255,
                        ]
                    ]
            ]
        );
        $complaints = Complain::with(['complainer', 'department', 'department.faculty', 'complain_sub_category', 'complain_sub_category.complain_category'])->get();
        $from = date($request->fromDate);
        $to = date($request->toDate);
        $complaints = $complaints->whereBetween('updated_at',[$from,$to]);
        $html = \view('pdf',['complaints' => $complaints])->render();
        $mpdf->WriteHTML($html);
        return $mpdf->output('complaint report.pdf','I');
    }

    public function createComplain(Request $request)
    {
        $complainer = null;
        $complain_sub_category = null;
        if ($request->student_name) {
            $complainer = Complainer::create($request->all());
        };
        if($request->complain_sub_category_id == null){
            $complain_sub_category = new ComplainSubCategory;
            $complain_sub_category->name = $request->other;
            $complain_sub_category->complain_category_id = 3;
            $complain_sub_category->save();
        };
        $complain = new Complain;
        $complain->complainer_id = $complainer ? $complainer->id : null;
        $complain->department_id = $request->department_id;
        $complain->complain_sub_category_id = $request->complain_sub_category_id ? $request->complain_sub_category_id : $complain_sub_category->id;
        $complain->objective = $request->objective;
        $complain->statement = $request->statement;
        $complain->save();
        // Check If user storage directory is exist
        // $directory = "/files/1";
        $directory = "/files/".$complain->id;
        if(!Storage::disk('public')->exists($directory)){
            Storage::disk('public')->makeDirectory($directory);
        }
        $paths = [];

        if($request->hasFile('references'))
        {
            // save files path to images table
            foreach($request->file('references') as $reference){
                $path = Storage::disk('local')->putFile($directory, $reference);
                array_push($paths, Storage::url($path));
            }

            // attach files path to complain
            $complain->reference = $paths;
        }
        $complain->save();
        return response()->json(
            [
                "status" => "ok",
                "path" => $paths
            ]
        );
    }

    public function getComplaint(Request $request)
    {
        $complaint = Complain::with(['complainer', 'department', 'department.faculty', 'complain_sub_category', 'complain_sub_category.complain_category'])->where('id',$request->id)->first();
        return response()->json(
            [
                "status" => "ok",
                "complaint" => $complaint
            ]
        );
    }

    public function getComplaints(Request $request)
    {
        $complaints = Complain::with(['complainer', 'department', 'department.faculty', 'complain_sub_category', 'complain_sub_category.complain_category'])->get();
        return response()->json(
            [
                "status" => "ok",
                "complaint" => $complaints
            ]
        );
    }

    public function getReferenceFile(Request $request){

    }

    public function updateComplaintProgress(Request $request)
    {
        $progress = array("unresolved", "resolving", "resolved");
        if (!in_array($request->progress, $progress)) {
            return response()->json(
                ["status" => "invalid progress"]
                , 200);
        }
        $complaint = Complain::find($request->id);
        $complaint->progress = $request->progress;
        $complaint->settlement_procedures = $request->settlement_procedures;
        $complaint->result_of_settlement = $request->result_of_settlement;
        $complaint->others = $request->others;
        $complaint->save();
        return response()->json(
            ["status" => "ok"]
            , 200);
    }

    public function getSummery(Request $request)
    {
        $groupedComplaintByFaculty = Faculty::with(['department.conplaint'])->get()->map(
            function ($complaint_faculty) {
                return [
                    "type" => $complaint_faculty->name,
                    "value" => $complaint_faculty->department->map(
                        function ($department) {
                            return $department->conplaint->count();
                        }
                    )->sum()
                ];
            }
        );
        $countComplaintByComplaintType = ComplainSubCategory::with(['complaint'])->get()->map(
            function ($complaint_by_category) {
                return [
                    "type" => $complaint_by_category->name,
                    "value" => $complaint_by_category->complaint->count()
                ];
            }
        );
        $countComplaintByProgress = Complain::all()->groupBy("progress")->map(
            function ($progress) {
                return $progress->count();
            }
        );
        $countComplaintByComplaintTypeInFaculty = Faculty::with(['department.conplaint'])->get()->map(
            function ($faculty) {
                //return $faculty;
                return [
                    "faculty" => $faculty->name,
                    "submissions" =>
                        $faculty->department->map(
                            function ($faculty_department) {
                                return $faculty_department->conplaint;
                            }
                        )->flatten()->groupby('complain_sub_category_id')->mapWithKeys(function ($complaint, $key) {
                            return [
                                ComplainSubCategory::find($key)->name => $complaint->count()
                            ];
                        })
                ];
            }
        );
        $countComplaintByGender = Complain::with('complainer')->get()->map(
            function ($item) {
                return $item->complainer;
            }
        )->groupBy('gender')->map(
            function ($item) {
                return $item->count();
            }
        )->merge(
            ['អនាមិក' => Complain::all()->count() - Complainer::all()->count()]
        );

        $countComplaintByYearInFaculty = Faculty::with(['department.conplaint.complainer'])->get()->map(
            function ($faculty) {
                //return $faculty;
                return [
                    "faculty" => $faculty->name,
                    "year" =>
                        $faculty->department->map(
                            function ($faculty_department) {
                                return $faculty_department->conplaint;
                            }
                        )->flatten()->map(function ($item) {
                            return $item->complainer;
                        })
                            ->groupBy('student_year')->mapWithKeys(function ($item, $key) {
                                return [$key ? $key : "អនាមិក" => $item->count()];
                            })
                ];
            }
        );

        $countComplaintByComplaintSuperType = Complain::with('complain_sub_category')->get()->map(
            function ($item) {
                return $item->complain_sub_category;
            }
        )->groupBy('complain_category_id')->mapWithKeys(
            function ($item, $keys) {
                return [ComplainCategory::find($keys)->name => $item->count()];
            }
        );

        $countComplaintByComplaintSuperTypeInEachMonth = Complain::with('complain_sub_category')->get()->groupBy(
            function ($item) {
                return substr($item['created_at'], 0, 7);
            }
        )->map(
            function ($item) {
                return $item->map(
                    function ($item) {
                        return $item->complain_sub_category;
                    }
                );
            }
        )->map(
            function ($item) {
                return $item->groupBy('complain_category_id');
            }
        )->map(
            function ($item) {
                return $item->mapWithKeys(
                    function ($item, $keys) {
                        return [ComplainCategory::find($keys)->name => $item->count()];
                    }
                );
            }
        );

        $countSolvedComplaintByCategory = Complain::where('progress', 'resolved')->get()->groupBy(
            'complain_sub_category_id'
        )->mapWithKeys(
            function ($item, $key) {
                return [ComplainSubCategory::find($key)->name => $item->count()];
            }
        );

        return response()->json(
            [
                "complaint_by_faculty" => $groupedComplaintByFaculty,
                "complaint_by_type" => $countComplaintByComplaintType,
                "complaint_by_progress" => $countComplaintByProgress,
                "complaint_by_complaint_type_in_faculty" => $countComplaintByComplaintTypeInFaculty,
                "complaint_by_gender" => $countComplaintByGender,
                "complaint_by_year_in_faculty" => $countComplaintByYearInFaculty,
                "complaint_by_super_type" => $countComplaintByComplaintSuperType,
                "complaint_by_super_type_in_each_mouth" => $countComplaintByComplaintSuperTypeInEachMonth,
                "complaint_only_solved_by_category" => $countSolvedComplaintByCategory
            ]
        );
    }
}
