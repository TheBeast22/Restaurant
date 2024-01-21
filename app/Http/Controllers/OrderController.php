<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function userOrders(){
        try{
        $user = auth()->user();
        $orders = $user->orders;
        if(!($orders->first()))
         return $this->notFoundResponse("you dont have any order");
        return $this->apiResponse(OrderResource::collection($orders));
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
        try{
        $validate = Validator::make($request->all(),[
            "restaurant_uuid" => "required|exists:restaurants,uuid",
            "order" => "required|array",
            "type" => "required|string|in:delivery,pickup",
            "status" => "required|string|in:not taked,taked"
        ]);
        if($validate->fails())
         return $this->requiredField($validate->errors());
        $user = auth()->user();
        $restaurant = Restaurant::where("uuid",$request->restaurant_uuid)->first();
        $items = $restaurant->menu;
        $names = [];
        foreach($items as $item)
         $names[$item->name] = $item->pivot->id;

        $order = Order::where("user_id",$user->id)->where("restaurant_id",$restaurant->id)->first();
        if($order)
          return $this->apiResponse("redirect to update the old");

        foreach($request->order as $name => $num)
         if(!is_numeric($num) || $num <= 0 || !isset($names[$name]))
            return $this->requiredField("your order not correct");

         $order = Order::create(["uuid"=>Str::uuid(),"user_id" => $user->id,"restaurant_id"=>$restaurant->id,"type"=>$request->type,"status"=>$request->status]);

        foreach($request->order as $name => $num)
             OrderItem::create(["order_id" => $order->id,"restaurant_item_id" => $names[$name],"number" => $num]);
        return $this->apiResponse("order added");
    }catch(\Exception $e){
        return $this->requiredField($e->getMessage());
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
