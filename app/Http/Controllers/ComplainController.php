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
use function PHPUnit\Framework\isNull;

class ComplainController extends Controller
{
    public function createComplain(Request $request)
    {
        $complainer = null;
        if ($request->student_name) {
            $complainer = Complainer::create($request->all());
        }
        $complain = new Complain;
        $complain->complainer_id = $complainer ? $complainer->id : null;
        $complain->department_id = $request->department_id;
        $complain->complain_sub_category_id = $request->complain_sub_category_id;
        $complain->objective = $request->objective;
        $complain->reference = $request->reference;
        $complain->statement = $request->statement;
        $complain->save();
        return response()->json(
            ["status" => "ok"]
        );
    }

    public function getComplaint(Request $request)
    {
        $complaint = Complain::with(['complainer', 'department', 'department.faculty', 'complain_sub_category', 'complain_sub_category.complainCategory'])->where('id',$request->id)->get()->first();
        return response()->json(
            [
                "status" => "ok",
                "complaint" => $complaint
            ]
        );
    }

    public function getComplaints(Request $request)
    {
        $complaints = Complain::with(['complainer', 'department', 'department.faculty', 'complain_sub_category', 'complain_sub_category.complainCategory'])->get();
        return response()->json(
            $complaints, 200
        );
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
