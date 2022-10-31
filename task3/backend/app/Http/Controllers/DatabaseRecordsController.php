<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\Models\User;

class DatabaseRecordsController extends Controller
{
    /**
     * This function is fetch records for the url and insert into the database
     * 
     * */

    function insertRecords(){
        $url = "https://randomuser.me/api/";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            
            $res = json_decode($response);
            $record = $res->results[0];
            $data = [
                'title'=>$record->name->title,
                'first'=>$record->name->first,
                'last'=>$record->name->last,
                'gender'=>$record->gender,
                'street'=>$record->location->street->number.' '.$record->location->street->name ,
                'city'=>$record->location->city,
                'state'=>$record->location->state,
                'country'=>$record->location->country,
                'postcode'=>$record->location->postcode,
                'email'=>$record->email,
                'phone'=>$record->phone,
                'picture'=>$record->picture->large,
            ];

            $isInsert = User::create($data);
            if($isInsert){
                echo "User inserted successfully";
            }else{
                echo "error";
            }
        }
    }
}
