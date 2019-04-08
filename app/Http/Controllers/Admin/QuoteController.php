<?php

namespace App\Http\Controllers\Admin;

use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quote;
use App\Category;
use App\ParentCategory;
use Excel;
use Validator;

class QuoteController extends Controller
{

    public function index()
    {

        $admin = auth()->guard('admin')->user();
        $items = $admin->quotes()->with('category');

        if (request('name')) {
            $name = '%' . strtolower(trim(request('name'))) . '%';
            $items->where(function ($query) use ($name) {
                $query->where('id','like', $name)
                    ->orWhere('quote_ar', 'like', $name)
                    ->orWhere('quote_en', 'like', $name)
                    ->orWhere('author_ar', 'like', $name)
                    ->orWhere('author_en', 'like', $name);
            });
        }
        $quotes = $items->latest()->paginate(15);

        if (request('name')) {
            $name = strtolower(trim(request('name')));
            $quotes->appends(['name' => $name]);
        }
           $categories = Category::all();
//        $parents = ParentCategory::all();
        return view('admin.quotes.quotes', compact(['quotes','categories']));
    }

    public function store(Request $request){
        $this->validate($request,[
            'quote_ar'=>'required|string|min:2',
            'quote_en'=>'required|string|min:2',
            'author_ar'=>'required|string|min:2',
            'author_en'=>'required|string|min:2',
            'tags'=>'required|string|min:2',
            'category_id'=>'required',
            'show'=>'required',
        ]);


        $admin = auth()->guard('admin')->user();
        $admin->quotes()->create([
            'quote_ar'=>$request['quote_ar'],
            'quote_en'=>$request['quote_en'],
            'author_ar'=>$request['author_ar'],
            'author_en'=>$request['author_en'],
            'tags'=>$request['tags'],
            'category_id'=>$request['category_id'],
            'show'=>$request['show'],
        ]);
        return redirect()->back()->with(['success' => 'Quote has been created successfully!']);
    }
    public function update(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'quote_ar'=>'required|string|min:2',
            'quote_en'=>'required|string|min:2',
            'author_ar'=>'required|string|min:2',
            'author_en'=>'required|string|min:2',
            'tags'=>'required|string|min:2',
        ]);


        $admin = auth()->guard('admin')->user();
        $quote = $admin->quotes()->find($request['id']);
        $quote->update([
            'quote_ar'=>$request['quote_ar'],
            'quote_en'=>$request['quote_en'],
            'author_ar'=>$request['author_ar'],
            'author_en'=>$request['author_en'],
            'tags'=>$request['tags'],
        ]);
        return redirect()->back()->with(['success' => 'Quote has been saved successfully!']);
    }
    public function show($id){
        $quote = Quote::find($id);
        if(!$quote){
            return  redirect()->back()->with(['error' => 'Selected Quote not found!']);
        }
        $quote->show = !$quote->show;
        $quote->save();
        return redirect()->back()->with(['success' => 'Quote Status has been changed successfully!']);

    }

    public function delete(Request $request){

        $product = Quote::find($request['id']);
        if(!$product){
            return response()->json(['error' =>'Selected Quote not found'], 200);
        }
        $product->delete();
        return response()->json(['success' => 'Quote has been deleted successfully!'], 200);
    }
}
