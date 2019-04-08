<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Quote;
use Auth;
use Validator;
class CategoryController extends Controller
{
    public function index(){
        $admin = auth()->guard('admin')->user();
        $items = $admin->categories();
        if (request('name')){
            $name = '%' . strtolower(trim(request('name'))) . '%';
            $items->where(function ($query) use ($name) {
                $query->where('id','like', $name)
                    ->orWhere('name_ar', 'like', $name)
                    ->orWhere('name_en', 'like', $name);
            });

        }
        $parents = $items->latest()->paginate(15);
        if (request('name')) {
            $name = strtolower(trim(request('name')));
            $parents->appends(['name' => $name]);
        }
        return view('admin.categories.parents',compact('parents'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'name_ar'=>'required|string|min:2',
            'name_en'=>'required|string|min:2',
            'color'=>'required|string|min:2',
            'icon'=>'required',
            'show'=>'required',
        ]);


        $icon = '';
        if(request('icon')){

            $name=md5(time()).".jpg";
            $icon = request('icon')->storeAs('images/categories',$name);

        }
        $admin = auth()->guard('admin')->user();
        $admin->categories()->create([
            'name_ar'=>$request['name_ar'],
            'name_en'=>$request['name_en'],
            'color'=>$request['color'],
            'icon'=>$icon,
            'show'=>$request['show'],
        ]);
        return redirect()->back()->with(['success' => 'Category has been created successfully!']);
    }
    public function update(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'name_ar'=>'required|string|min:2',
            'name_en'=>'required|string|min:2',
            'color'=>'required|string|min:2'
        ]);


        $admin = auth()->guard('admin')->user();
        $category = $admin->categories()->find($request['id']);
        $category->update([
            'name_ar'=>$request['name_ar'],
            'name_en'=>$request['name_en'],
            'color'=>$request['color'],
        ]);
        return redirect()->back()->with(['success' => 'Category has been saved successfully!']);
    }
    public function show($id){
        $parent = Category::find($id);
        if(!$parent){
            return  redirect()->back()->with(['error' => 'Selected Category not found!']);
        }
        $parent->show = !$parent->show;
        $parent->save();
        return redirect()->back()->with(['success' => 'Category Status has been changed successfully!']);

    }
    public function quotes($id){

    $admin = auth()->guard('admin')->user();
    $category = $admin->categories()->find($id);
    if(!$category){
        return back()->with(['error'=>'The selected category does not exist!']);

    }
    $items = $category->quotes();
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
    $category_name = $category->name_ar;
  return view('admin.categories.quotes',compact(['quotes','category_name','categories']));

}
    public function delete(Request $request){

        $parent = Category::find($request['id']);
        if(!$parent){
            return response()->json(['error' =>'Selected Category not found'], 200);
        }
        $quotes = $parent->quotes;
        if(count($quotes)){
            return response()->json(['error' =>'Selected Category has quotes!'], 200);
        }
        $parent->delete();
        return response()->json(['success' => 'Category has been deleted successfully!'], 200);
    }

}
