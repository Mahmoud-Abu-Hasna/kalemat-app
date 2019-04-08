<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\QuoteCollection;
use App\Quote;
use App\Category;
use App\User;


class CategoryController extends MainController
{
    //
    public function index(){
// get all categories api
        $categories = Category::query()->where('show',1)->get();
        $items =  CategoryCollection::collection($categories);
        return $this->customResponse(200,'true','Categories Back!',$items);
    }

    public function categoryQuotes($id){
        $category = Category::find($id);
        if(!$category){
            return $this->customResponse(400,'false','Category Not Found!',[]);
        }
        $quotes = $category->quotes()->with('category');
        if (request('name')) {
            $name = '%' . strtolower(trim(request('name'))) . '%';
            $quotes->where(function ($query) use ($name) {
                $query->where('quote_ar', 'like', $name)
                    ->orWhere('quote_en', 'like', $name)
                    ->orWhere('author_en', 'like', $name)
                    ->orWhere('author_ar', 'like', $name);
            });
        }
        $quotes = $quotes->paginate(50);
        if (request('name')) {
            $name = strtolower(trim(request('name')));
            $quotes->appends(['name' => $name]);
        }

        $items =  QuoteCollection::collection($quotes);
        return $this->customResponse(200,'true','Quotes Back!',$quotes);
    }


}
