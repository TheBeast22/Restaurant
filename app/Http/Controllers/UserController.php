<?php

namespace App\Http\Controllers;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    use GeneralTrait;
    public function login(Request $request){
        try{
        $validate = Validator::make($request->all(),[
            "email" => "required|email|exists:users,email|ends_with:yahoo.com,hotmail.com,gmail.com|min:11|max:50",
            "password" => "required|string|min:8|max:50",
        ],["email.exists" =>"Your Not Regestered!!"]);
        if($validate->fails())
         return $this->requiredField($validate->errors());
        $user = User::where("email",$request->email)->first();
        if(!Hash::check($request->password,$user->password))
          return $this->unAuthorizeResponse();
        return $this->apiResponse($user->createToken("token")->plainTextToken);
    }catch(\Exception $e)
    {
        return $this->requiredField($e->getMessage());
    }
    }
    public function register(Request $request){
        try{
        $validate = Validator::make($request->all(),[
            "name" => "required|string|min:3|max:10",
            "email" => "required|email|unique:users,email|ends_with:yahoo.com,hotmail.com,gmail.com|min:11|max:50",
            "password" => "required|string|min:8|max:50",
        ],["email.exists" =>"Your Not Regestered!!"]);
        if($validate->fails())
         return $this->requiredField($validate->errors());
        return $this->apiResponse(User::create(["uuid"=>Str::uuid(),"name"=>$request->name,"email"=>$request->email,"password"=>Hash::make($request->password)]));
    }catch(\Exception $e){
        return $this->requiredField($e->getMessage());
    }
    }
    public function logout(){
        try{
        $ans = auth()->user()->tokens()->delete();
        return $this->apiResponse(($ans)? "logedout" : "can't logout");
        }catch(\Exception $e){
            return $this->requiredField($e->getMessage());
        }
    }
}
