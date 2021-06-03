<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    public function addstate(Request $request)
    {
        for($i=0;$i<sizeof($request->states);$i++)
        {
            $state = new State();
            $state->startDate=$request->states[$i]['startDate'];
            $state->status=$request->states[$i]['status'];
            $state->fileURL=$request->states[$i]['fileURL']->storePublicly('images');

            $state-> idRegistrationF =$request->idRegistration;
            $state->save();
        }

    }
    public function updatestate(Request $request)
    {

        $payment=State::where('idState',$request->idState)->where('idRegistrationF',$request->idRegistration)->first();
        $payment->startDate=is_null($request->startDate) ? $payment->startDate : $request->startDate;
        $payment->status=is_null($request->status) ? $payment->status : $request->status;
        $payment->fileURL=is_null($request->fileURL) ? $payment->fileURL : $request->fileURL->storePublicly('images');
        $payment->save();
    }
    public function deletestate($id)
    {
        return State::where('idState',$id)->delete();
    }
}
