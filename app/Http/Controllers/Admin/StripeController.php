<?php

namespace App\Http\Controllers\admin;
use App\Models\booking;
use App\Models\room;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Stripe\StripeClient;
use Stripe\Exception\CardException;
class StripeController extends Controller

{
    public function indexPayment(Request $request,$id)
    {

        $pay = booking::find($id);


        return view('web.stripe.index',compact('pay'));
    }

    public function storePayment(Request $request,$id)
    {

        DB::table('booking')
        ->where('id', $id)
        ->update(['status' => 2]);
        try {
            $stripe = new StripeClient(env('STRIPE_SECRET'));

            $stripe->paymentIntents->create([
                'amount' => 99 * 100,
                'automatic_payment_methods[enabled]'=>true,
                'automatic_payment_methods[allow_redirects]'=>'never',
                'currency' => 'usd',
                'payment_method' => $request->payment_method,
                'description' => 'Demo payment with stripe',
                'confirm' => true,
                'receipt_email' => $request->email
            ]);
        } catch (CardException $th) {
            throw new Exception("There was a problem processing your payment", 1);
        }
        $id = Auth::user()->id;
        return redirect()->route('history', ['id' => $id])->withSuccess('Payment done.');
    }
}
