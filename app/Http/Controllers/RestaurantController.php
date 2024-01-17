<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Resources\RestaurantResource;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
        $request["return_type"] = "basic";
        $restaurants = Restaurant::all();
        if(!($restaurants->first()))
            return $this->notFoundResponse("no restaurants found!");
        return $this->apiResponse(RestaurantResource::collection($restaurants));
        }catch(\Exception $e){
            return $this->requiredField($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$name)
    {
        try{
        $validate = Validator::make(["name" => $name],[
            "name" => "required|string",
        ]);
        if($validate->fails())
         return $this->requiredField($validate->errors());
        $restaurant = Restaurant::where("name",$name)->first();
        if(!$restaurant)
         return $this->notFoundResponse("there is no restaurant with name $name");
        return $this->apiResponse(RestaurantResource::make($restaurant));
    }
    catch(\Exception $e){
        return $this->requiredField($e->getMessage());
    }
    }
    public function showByCuisineType(Request $request){
        try{
        $validate = Validator::make($request->all(),[
            "cuisine_type" => "required|string"
        ]);
        if($validate->fails())
         return $this->requiredField($validate->errors());
        $request["return_type"] = "basic";
        $restaurants = Restaurant::where("cuisine_type",$request->cuisine_type)->get();
        if(!($restaurants->first()))
         return $this->notFoundResponse("there is no restaurants with cuisine type $request->cuisine_type");
        return $this->apiResponse(RestaurantResource::collection($restaurants));
    }catch(\Exception $e){
        return $this->requiredField($e->getMessage());
    }
    }
    public function showByAddress(Request $request){
        try{
        $validate = Validator::make($request->all(),[
            "address" => "required|string"
        ]);
        if($validate->fails())
         return $this->requiredField($validate->errors());
        $request["return_type"] = "basic";
        $restaurants = Restaurant::where("address",$request->address)->get();
        if(!($restaurants->first()))
         return $this->notFoundResponse("there is no restaurants with address type $request->address");
        return $this->apiResponse(RestaurantResource::collection($restaurants));
    }
        catch(\Exception $e){
            return $this->requiredField($e->getMessage());
        }
    }
    public function showByAddressAndCuisinType(Request $request){
        try{
        $validate = Validator::make($request->all(),[
            "cuisine_type" => "required|string",
            "address" => "required|string",
        ]);
        if($validate->fails())
         return $this->requiredField($validate->errors());
        $request["return_type"] = "basic";
        $restaurants = Restaurant::where("address",$request->address)->where("cuisine_type",$request->cuisine_type)->get();
        if(!($restaurants->first()))
         return $this->notFoundResponse("there is no restaurants with cuisine type $request->cuisine_type with the address $request->address");
        return $this->apiResponse(RestaurantResource::collection($restaurants));
    }catch(\Exception $e){
        return $this->requiredField($e->getMessage());
    }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
