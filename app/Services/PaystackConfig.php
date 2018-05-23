<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 12/12/2017
 * Time: 2:48 PM
 */

namespace App\Services;


use Exception;
use Illuminate\Support\Facades\Redirect;
use nilsenj\Toastr\Facades\Toastr;


class PaystackConfig{

    public $request_url = 'https://api.paystack.co/transaction/initialize';

    public $query_url = 'https://api.paystack.co/transaction/verify';

    public $test_secret_key = 'sk_test_ac21a0e9ae37d41a4d316980639cfd976a016862';

    public $live_secret_key = '';

    public $test_public_key = 'pk_test_40dd5275ea626aad229cfedb1c06c961985b64d4';

    public $live_public_key = '';

    public function __construct(){
        $this->secretKey = $this->test_secret_key;
        $this->publicKey = $this->test_public_key;
    }

    public function initialize($email,$amount,$txnRef,$redirectUrl){

        $postData =  [
            'email' => $email,
            'amount' => $amount,
            "reference" => $txnRef,
            "callback_url" => $redirectUrl
            ];
        
        $url = $this->request_url;

        $headers = [
            'Authorization: Bearer '.$this->secretKey,
            'Content-Type: application/json',
        ];

        $info = [
            'txn_reference' => $txnRef,
            'user_id' => auth()->user()->id,
            'amount' => $amount,
            'gateway_id' => 2,
            'payment_status' => 0
        ];



        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postData));  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec ($ch);
        curl_close ($ch);

        if(empty($response)){

           Toastr::error('Bad internet connection. Unable to process payment.');
           return back();

        }else{

            $response = json_decode($response, true);
            if(!isset($response['data']['authorization_url'])){

               return 2;

            }elseif(isset($response['data']['authorization_url'])){

                $url = $response['data']['authorization_url'];

                return Redirect::to($url);

            }
        }

    }

    public function query($txnRef){
        $url = $this->query_url."/".$txnRef;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer '. $this->secretKey]
        );
        $response = curl_exec($ch);
        curl_close($ch);
        return $this->queryValidator($txnRef,$response);
    }

    public function queryValidator($txnRef,$response){
        if(empty($response)){

            return [
                'reference' => $txnRef,
                'status' => 0,
                'responseCode' => '--',
                'responseDescription' => 'Could not confirm Payment Status, Bad Internet Connection',
                'responseFull' => '0',
                'amount' => '0'
            ];

        }else{
            $response = json_decode($response, true);
            if(isset($response['status'])){
                if($response['status'] == true){
                    return [
                        'reference' => $txnRef,
                        'status' => 1,
                        'responseCode' => '00',
                        'responseDescription' => 'Payment Successful',
                        'responseFull' => json_encode($response,true),
                        'amount' => $response['data']['amount']
                    ];

                }elseif($response['status'] == false){
                    return [
                        'reference' => '',
                        'status' => 0,
                        'responseCode' => 0,
                        'responseDescription' => $response['message'],
                        'responseFull' => json_encode($response,true),
                        'amount' => 0
                    ];
                }


            }else{

                return [
                    'reference' => $txnRef,
                    'status' => 0,
                    'responseCode' => '--',
                    'responseDescription' => 'Payment Not Successful',
                    'responseFull' => json_encode($response,true),
                    'amount' => 0
                ];

            }
        }
    }

}