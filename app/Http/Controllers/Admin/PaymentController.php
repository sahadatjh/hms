<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hajji;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $data['hajjis'] = Hajji::where('status',1)->orWhere('status',2)->get();
        return view('admin.payments.index',$data);
    }

    public function store(Request $request)
    {
        $req = $request->all();
        $req['payment_date'] = $req['payment_date'] ? date('Y-m-d H:i:s',strtotime($req['payment_date'])) : now();
        Payment::create($req);
        return redirect()->back()->withSuccess('Payment received successfully!');
    }

    public function dueList()
    {
        $data['hajjis'] = Hajji::with('payments')->get();
        return view('admin.payments.due-list',$data);
    }

    public function getPaymentsByHajji(Request $request)
    {
        $payments = Payment::where('hajji_id',$request->id)->get();
        return response()->json(['success'=>true, 'data'=>$payments]);
    }
}
// public function getHajjiById(Request $request)
//     {
//         $req = $request->all();
//         // dd($req);
//         $hajji = Hajji::where('id',$req['id'])->with('payments')->first();
//         return response()->json(['success'=>true, 'data'=>$hajji]);
//     }