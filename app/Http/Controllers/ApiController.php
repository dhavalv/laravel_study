<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Mockery\CountValidator\Exception;
use Validator;
use Auth;
class ApiController extends Controller
{
    //
    public function getToken(){
        $token = request()->session()->get('_token');
        return $this->responseJson(null,['access_token'=>$token],null,200);
    }
    public function doLogin(){
        $email = request()->get('email');
        $password = request()->get('password');
        $rules = [
            'email' => 'required|email:true',
            'password' => 'required|max:50'
        ];
        $validator = Validator::make(request()->all(),$rules);
        if($validator->fails()){
            $messages = $validator->errors()->getMessages();
            return $this->responseJson(request()->all(),null,$messages,201);
        }else{
            if(Auth::attempt(['email' => request('email'),'password' => request('password')])){
                return $this->responseJson(request()->all(),null,"Successfully login here!",200);
            }else{
                return $this->responseJson(request()->all(),null,"email and password is not valid",201);
            }
        }
    }
    public function doLogout(){
        return Auth::logout();
    }
    public function getUsers(){
        $users = \App\User::all();
        return $this->responseJson(null,$users,null,200);
    }
    public function storeUser(){
        print_r(session()->all());
    }
    protected function responseJson($params,$rsData,$msg,$rsStatus){
        $token = request()->session()->get('_token');
        return response([
            'responseData' => [
                'queryString' => $params,
                'resultData' => $rsData,
            ],
            'message' => $msg,
            'responseStatus' => $rsStatus
        ]);
    }
}
