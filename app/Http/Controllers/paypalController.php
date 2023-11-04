<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;


class paypalController extends Controller
{
    //
    public function payment(Request $request){
        $name=$request->name;
        $price=$request->payment;
        $qty=$request->qty;

        $data=[];
        $data['items']=[
            [
                'name'=>$name,
                'price'=>$price
            ]
        ];
        $data['invoice_id']=1;
        $data['invoice_description']="order invoice";
        $data['return_url']=route('payment.success');
        $data['cancel_url']=route('payment.cancel');
        $data['total']=$price*$qty;

        $provider=new ExpressCheckout;
        $response=$provider->setExpressCheckout($data);
        $response=$provider->setExpressCheckout($data,true);
        return redirect($response['paypal_link']);

    }
    public function cancel(){
        dd('you are cancelled this payment');
    }
    public function success(Request $request){
        $provider=new ExpressCheckout;
        $response=$provider->getExpressCheckoutDetails($request->token);
        if(in_array(strtoupper($response['ACK']),['SUCCESS','SUCCESSWITHWARNING'])){
            dd('YOUR PAYMENT is success thanks');

        }
        dd('please try again');

    }

}
