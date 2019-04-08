<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuoteCollection extends JsonResource
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
            'quote_ar' => $this->quote_ar??'',
            'quote_en' => $this->quote_en??'',
            'author_ar' => $this->author_ar??'',
            'author_en' => $this->author_en??'',
            'tags' => $this->tags??'',
            'fave' => $this->fave??'',
            'category_id' => $this->category->id,
            'category_ar' => $this->category->name_ar,
            'category_en' => $this->category->name_en,
            'category_color' => $this->category->color??'',
            'category_icon' => $this->category->icon??'',
        ];
    }
}
