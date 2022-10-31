<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use DB;


class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function display(Request $request)
    {   

        $response =array();
        $validator = Validator::make($request->all(), [
            'offset' => 'required'
        ]);
        /*
            Check validation required params
        */
        if ($validator->fails()) {
            $validator = $validator->errors();
            $response['status'] = false;
            $response['message'] = $validator->first();
            return response()->json($response);
        }

        $offset =  $request->input('offset');
        $limit =  $request->input('limit') ? $request->input('limit') : 5;

        $users = User::skip($offset)->take($limit)->get();
        $message = '';
        
        if(count($users)){
            $message = 'User Records fetched successfully!';
            $status = 200;
        }else{
            $message = 'User Records not available!';
            $status = 404;
        }

        $response = array('status'=>$status, 'message' => $message,'users' => $users);
        return json_encode($response);
    }


    /**
     * Update the specified resource
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request)
    {
        $user = User::find($request->id);

        if($user){
            try {
                $user->title = $request->title;
                $user->first = $request->first;
                $user->last = $request->last;
                $user->gender = $request->gender;
                $user->street = $request->street ;
                $user->city = $request->city;
                $user->state = $request->state;
                $user->country = $request->country;
                $user->postcode = $request->postcode;
                $user->email = $request->email;
                $user->phone = $request->phone;

                $result = $user->save();

                if($result){
                    $response = array('status'=> 200, 'message' => "User Update successfully!");
                    return json_encode($response);  
                }else{
                    $response = array('status'=>404, 'message' => " Update Operation failed !");
                    return json_encode($response);  
                }  
            }catch( \Exception $e){
                    DB::rollback();
                   return response()->json([
                    'status' => false,
                    'message' =>'Missing Data, Please try again',
                    'status_code'=>422,
                ],500);
            }
           
        }else{
            $response = array('status'=>404, 'message' => "User Not available !");
            return json_encode($response); 
        }
    }

    /*
    * For the csv Fetch all the user record from the database and give response.
    */
    
    public function csvExport(){
        $response =array();

        $users = User::all();
        $message = '';
        
        if(count($users)){
            $message = 'User Records fetched successfully!';
            $status = 200;
        }else{
            $message = 'User Records not available!';
            $status = 404;
        }

        $response = array('status'=>$status, 'message' => $message,'users' => $users);
        return json_encode($response);
    }
  
}
