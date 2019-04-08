<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
        'id' => $this->id,
        'name_ar' => $this->name_ar,
        'name_en' => $this->name_en,
        'color' => $this->color,
        'icon' => strpos($this->icon,'http')?$this->icon:asset($this->icon),
              ];
    }
}
