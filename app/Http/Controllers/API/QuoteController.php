<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Resources\QuoteCollection;
use App\Quote;
use App\Category;
use App\User;


class QuoteController extends MainController
{
    //
    public function index(){

        $quotes = Quote::query()->with('category');
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
    public function show($id){

        $quote = Quote::find($id);
        if(!$quote){
            return $this->customResponse(400,'false','Quote Not Found!',[]);
        }
        $item =  new QuoteCollection($quote);
        return $this->customResponse(200,'true','Quote Back!',[$item]);

    }

    public function quotesByTag($tag){
        $tag_search = '%' . strtolower(trim($tag)) . '%';
        $quotes = Quote::query()->with('category')->where('tags','like',$tag_search)->get();
        $items =  QuoteCollection::collection($quotes);
        return $this->customResponse(200,'true','Quotes Back!',$items);
    }
    public function fave($id,$status = 1){
        $quote = Quote::find($id);
        if(!$quote){
            return $this->customResponse(400,'false','Quote Not Found!',[]);
        }
        $message = 'Fav Increase!';
        if($status){
            $quote->fave = $quote->fave + 1;
        }else{
            if($quote->fave > 0){
                $quote->fave = $quote->fave - 1;
            }
            $message = 'Fav Decrease!';

        }
        $quote->save();
        return $this->customResponse(200,'true',$message,[]);
    }
    public function randomQuotes(){
        $quotes = Quote::query()->with('category')->inRandomOrder()->limit(50)->get();
        $items =  QuoteCollection::collection($quotes);
        return $this->customResponse(200,'true','Quotes Back!',$items);
    }
    public function quotesByLang($lang){
        $quotes = Quote::query()->with('category')->whereNotNull('quote_'.$lang)->inRandomOrder()->limit(50)->get();
        $items =  QuoteCollection::collection($quotes);
        return $this->customResponse(200,'true','Quotes Back!',$items);
    }
    public function prevInCategory($cate_id,$id){

        $quote = Quote::query()->where('category_id',$cate_id)->where('id','<',$id)->orderBy('id','desc')->first();
        if(!$quote){
            return $this->customResponse(400,'false','Quote Not Found!',[]);
        }
        $item =  new QuoteCollection($quote);
        return $this->customResponse(200,'true','Quote Back!',[$item]);

    }
    public function nextInCategory($cate_id,$id){
        $quote = Quote::query()->where('category_id',$cate_id)->where('id','>',$id)->orderBy('id','asc')->first();
        if(!$quote){
            return $this->customResponse(400,'false','Quote Not Found!',[]);
        }
        $item =  new QuoteCollection($quote);
        return $this->customResponse(200,'true','Quote Back!',[$item]);
    }
    public function prevQuote($id){

        $quote = Quote::query()->where('id','<',$id)->orderBy('id','desc')->first();
        if(!$quote){
            return $this->customResponse(400,'false','Quote Not Found!',[]);
        }
        $item =  new QuoteCollection($quote);
        return $this->customResponse(200,'true','Quote Back!',[$item]);

    }
    public function nextQuote($id){
        $quote = Quote::query()->where('id','>',$id)->orderBy('id','asc')->first();
        if(!$quote){
            return $this->customResponse(400,'false','Quote Not Found!',[]);
        }
        $item =  new QuoteCollection($quote);
        return $this->customResponse(200,'true','Quote Back!',[$item]);
    }

}
