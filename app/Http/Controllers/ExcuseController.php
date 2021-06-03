<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Excuse;

class ExcuseController extends Controller
{
    public function addexcuse(Request $request)
    {


        for($i=0;$i<sizeof($request->excuses);$i++)
        {
            $excuse = new Excuse();
            $excuse->excuseDate	= $request->excuses[$i]['excuseDate'];
            $excuse->cancelDate	= $request->excuses[$i]['cancelDate'];
            $excuse->submittedDocURL = $request->excuses[$i]['submittedDocURL']->storePublicly('images');
            $excuse->extendedPeriodDocURL	= $request->excuses[$i]['extendedPeriodDocURL']->storePublicly('images');
            $excuse->numberMonthExtendedPeriod	= $request->excuses[$i]['numberMonthExtendedPeriod'];
            $excuse->content	= $request->excuses[$i]['content'];
            $excuse->idRegistrationF =$request->idRegistration;
            $excuse->save();
        }
    }
    public function updateexcuse(Request $request)
    {

        $excuse=Excuse::where('idRegistrationF',$request->idRegistration)->where('idExcuse',$request->idExcuse)->first();
        $excuse->excuseDate=is_null($request->excuseDate) ? $excuse->excuseDate : $request->excuseDate;
        $excuse->cancelDate=is_null($request->cancelDate) ? $excuse->cancelDate : $request->cancelDate;
        $excuse->submittedDocURL=is_null($request->submittedDocURL) ? $excuse->submittedDocURL : $request->submittedDocURL->storePublicly('images');
        $excuse->extendedPeriodDocURL=is_null($request->extendedPeriodDocURL) ? $excuse->extendedPeriodDocURL : $request->extendedPeriodDocURL->storePublicly('images');
        $excuse->numberMonthExtendedPeriod=is_null($request->numberMonthExtendedPeriod) ? $excuse->numberMonthExtendedPeriod : $request->numberMonthExtendedPeriod;
        $excuse->content=is_null($request->content) ? $excuse->content : $request->content;
        $excuse->save();
    }
    public function deleteexcuse(Request $request,$id)
    {
        return Excuse::where('idExcuse',$id)->delete();

    }
}
