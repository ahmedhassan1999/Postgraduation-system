<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function addpayment(Request $request)
    {

        for($i=0;$i<sizeof($request->payments);$i++)
        {
            $payment =new Payment();
            $payment->receiptNumber=$request->payments[$i]['receiptNumber'];
            $payment->amountPaid=$request->payments[$i]['amountPaid'];
            $payment->URLImage=$request->payments[$i]['URLImage']->storePublicly('images');
            $payment->paymentDate=$request->payments[$i]['paymentDate'];
            $payment->forYear=$request->payments[$i]['forYear'];
            session_start();
            $payment-> idRegistrationF =$_SESSION['id_registration'];
            $payment->save();


        }
    }
    public function updatepayment(Request $request)
    {
        session_start();
        $payment=Payment::where('idPayment',$request->idPayment)->where('idRegistrationF',$_SESSION['id_registration'])->first();
        $payment->receiptNumber=is_null($request->receiptNumber) ? $payment->receiptNumber : $request->receiptNumber;
        $payment->amountPaid=is_null($request->amountPaid) ? $payment->amountPaid : $request->amountPaid;
        $payment->URLImage=is_null($request->URLImage) ? $payment->URLImage : $request->URLImage->storePublicly('images');
        $payment->paymentDate=is_null($request->paymentDate) ? $payment->paymentDate : $request->paymentDate;
        $payment->forYear=is_null($request->forYear) ? $payment->forYear : $request->forYear;
        $payment->save();


    }
    public function deletepayment(Request $request,$id)
    {
         Payment::where('idPayment',$id)->delete();

    }
}
