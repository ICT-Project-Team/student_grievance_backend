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
        $complain->complain_sub_category_id = $request->complain_sub_category_id;
        $complain->objective = $request->objective;
        $complain->reference = $request->reference;
        $complain->statement = $request->statement;
        $complain->save();
        return $complain;
    }

    public function getComplaint(Request $request)
    {
        $complaints = Complain::all();
        return response()->json(
            $complaints,400
        );
    }
}
