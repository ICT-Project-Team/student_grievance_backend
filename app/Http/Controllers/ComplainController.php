<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Models\Complainer;
use Illuminate\Http\Request;

class ComplainController extends Controller
{
    public function createComplain(Request $request){
        $complainer = Complainer::create($request->all());
        $complain = new Complain;
        $complain->complainer_id = $complainer->id;
        $complain->complain_sub_category_id = $request->complain_sub_category_id;
        $complain->objective = $request->objective;
        $complain->reference = $request->reference;
        $complain->statement = $request->statement;
        $complain->save();
        return $complain;
    }
}
