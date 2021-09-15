<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentDetail;
class PaymentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $payments = Payment::with('payment_detail')->get();
        
        return view('admin.payment', compact('payments'));
        
    }
    public function store(Request $request)
    {
        $request->validate([
            'total_bonus' => 'required|numeric',
            'buruh.*.bonus' => 'required|numeric',
        ]);
        $buruh = $request->buruh;
       
        $payment = Payment::create([
            'payment_total'     => $request->total_bonus,
            
         ]);

        $data = array();
        for ($i=0; $i < count($buruh) ; $i++) { 
            $data[] =[
                'payment_id' => $payment->id,
                'laborer_name' => $buruh[$i]['nama'],
                'persentase' => $buruh[$i]['bonus'],
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
               ];             
        }
    
        PaymentDetail::insert($data);
       
        return redirect('/payment')->with('Completed', 'Data has been saved!');
    }
    public function edit(Request $request, $id)
    {
        // print_r('sampai');
        // exit;
        $updateData = $request->validate([
            'databuruh.*' => 'required|numeric',
        ]);
        
        $buruh = $request->databuruh;
        $dataid = $request->dataid;
        // print_r($dataid[1]); 
        // exit;
        for ($i=0; $i < count($buruh) ; $i++) { 
            $data =[
                'persentase' => $buruh[$i],
                'updated_at'=> date('Y-m-d H:i:s')
               ];     
               PaymentDetail::whereId($dataid[$i])->update($data);
                     
        }
        
        
        
      
     
        return redirect('/payment')->with('completed', 'Payment has been updated');
    }
    public function update($id)
    {
    	$payment = Payment::find($id);
        $detail = PaymentDetail::where('payment_id',$id)->get();

	    return response()->json([
	      'data' => $payment,
          'detail' => $detail
	    ]);
    }
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect('/payment')->with('completed', 'Data has been deleted');
    }
}
