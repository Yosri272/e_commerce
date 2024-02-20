<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtpSmsAPIController extends Controller
{
           public function index(Request $request)
    {
        
         $phone='0917775573';
         $phone1='0925599920';
        // $phone2='0997414401';
         $text='Hello World';
         $enc = base64_encode($text);
           
           
           
           
        $headers = [

            'Content-Type:application/json'
             
             ];

        $data1 = [
            'username' => 'bejaii',
            'password' => 'bejaii1#',
            'bulk' => [
                     'phone'=> [ $phone ,$phone1  ], // array of strings contains phone numbers
                     'text'=> $text,
                     'text_encode'=> $enc , //utf-8, urlencode or base64
                    
                    ],

         
        ];
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
         //   CURLOPT_URL => "https://api.gawali.net/",// your preferred url
         CURLOPT_URL => "https://3f0f265b-34b9-4a98-a892-c9851af77897.mock.pstmn.io",
           //CURLOPT_URL => "https://c74b22a5-4b67-4430-ba57-56546caa44b9.mock.pstmn.io",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data1),
            CURLOPT_HTTPHEADER => $headers,
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        echo curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error :" . $err;
        } else {
        /// print_r(json_decode($response));
         //print_r($response);
          return $this->sendResponse($response, 'your verification code');
        }


    }
}
