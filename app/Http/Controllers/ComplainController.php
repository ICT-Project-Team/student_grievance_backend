<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Models\Complainer;
use Illuminate\Http\Request;

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
        return $complain;
    }

    public function getComplaints(Request $request)
    {
        $complaints = Complain::with(['complainer','department','department.faculty'])->get();
        return response()->json(
            $complaints, 400
        );
    }

    public function updateComplaintProgress(Request $request){
        $progress = array("unresolved", "resolving", "resolved");
        if (!in_array($request->progress, $progress)){
            return response()->json(
                ["status" => "invalid progress"]
                ,200);
        }
        $complaint = Complain::find($request->id);
        $complaint->progress = $request->progress;
        $complaint->save();
        return response()->json(
            ["status" => "ok"]
        ,200);
    }

    public function getSummaryComplaints(Request $request){

    }
}
