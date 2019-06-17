<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use PHPUnit\Runner\Exception;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::with(['childs'])->where('parent_id', 0)->paginate(20);
        return response()->json($categories, 200);
        
    }

    public function show($id)
    {
        //
    }

    public function create(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required|max:255',            
        ]);

        if ($request->has('parent_id')) {
            $parent_id = $request->parent_id;
        }else{
            $parent_id = 0;
        }
        
        $category = Category::create([
            'name'          => $request->name,
            'parent_id'     => $parent_id
        ]);

        return response()->json($category, 200);

    }


    public function update($id, Request $request)
    {
        
        $this->validate($request, [
            'name' => 'max:255',
        ]);
        
        
        if(!Category::find($id)) return response()->json(['message' => "Category not found!"], 400);

        if ($request->has('parent_id')) {
            $parent_id = $request->parent_id;
        }else{
            $parent_id = 0;
        }

        
        $category = Category::find($id)->update(['name' => $request->name, 'parent_id' => $parent_id]);
        
        if($category){
            return response()->json(['message' => "Category updated found!"], 200);
        }
        
        return response()->json(['message' => "Something wrong."], 200);
    }

    public function destroy($id)
    {
                
        if(!Category::find($id)) return response()->json(['message' => "Category not found!"] ,201);

        if(Category::find($id)->delete()){
            return response()->json(['message' => "Category deleted sucessfully."] ,200);
        }
        
        return response()->json(['message' => "Something wrong!"] ,400);
    }
}
