<?php
namespace App\Http\Controllers\Admin;

use Dompdf\Dompdf;
use App\Models\Hajji;
use App\Models\Payment;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {
        $data['hajjis'] = Hajji::where('status',1)->orWhere('status',2)->get();
        return view('admin.payments.index',$data);
    }

    public function store(Request $request)
    {
        try {
            $hajji = Hajji::find($request->hajji_id);
            if ($hajji) {
                $due = $hajji->package->price - ($hajji->discount + $hajji->payments->sum('amount'));

                if ($request->amount > $due ) {
                    throw new Exception('Amount must be less then due!');
                }
            }

            $req = $request->all();
            $req['payment_date'] = $req['payment_date'] ? date('Y-m-d H:i:s',strtotime($req['payment_date'])) : now();
            
            Payment::create($req);
            return redirect()->back()->withSuccess('Payment received successfully!');
        } catch (\Throwable $th) {
            return [
                'messege'       => $th->getMessage(),
                'success'   => false,
                // "line"      => $th->getLine(),
            ];
        }
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

    public function moneyReceipt($id    )
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml('admin.payments.');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream();
    }

    public function monyReceiptPDF($payments)
    {
        $pdf        = PDF::setOptions([
            'defaultFont'           => 'tahoma',
            'isHtml5ParserEnabled'  => true,
            'debugCss'              => true,
        ])->loadView('admin.money-receipt-pdf');
    }
}

