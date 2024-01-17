<?php

namespace App\Http\Resources;

use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $order = $this->makeOrder();
        return [
            "uuid" => $this->uuid,
            "type" => $this->type,
            "status" => $this->status,
            "resturant"=> $this->restaurant->name,
            "items" => ($order)? $order : "you have no orders",
            "overall price"=>$this->price . "$"
        ];
    }
    private $price = 0;
    private function makeOrder(){
        $order = [];
        foreach($this->items as $item){
         if($item->restaurant_id == $this->restaurant_id){
         $this->price += $item->price * $item->pivot->number;
         $order[$item->item->name] = "number: " . $item->pivot->number . " price: " . $item->price * $item->pivot->number . "$";}
        }
        return $order;
    }
}
