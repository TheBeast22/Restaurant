<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      $avgrate = $this->average_rating;
      if(isset($request["return_type"]))
        return [
            "uuid" => $this->uuid,
            "name" => $this->name,
            "cuisine type" => $this->cuisine_type,
            "average rating" => ($avgrate < 0)? "this restaurant not rated yet" : $avgrate,
        ];
      $menu = $this->makeMenu();
      $menu = ($menu)? $menu : "this restaurant donsn't have menu yet";
      return [
        "uuid" => $this->uuid,
        "name" => $this->name,
        "cuisine type" => $this->cuisine_type,
        "address" => $this->address,
        "email" => $this->email,
        "phone" => $this->phone,
        "average rating" => ($avgrate < 0)? "this restaurant not rated yet" : $avgrate,
        "menu" => $menu
      ];
    }
    private function makeMenu(){
      $menu = [];
      $items = $this->menu;
      foreach($items as $item)
        $menu[$item->name] = $item->pivot->price ."$";
      return $menu;
    }
}
