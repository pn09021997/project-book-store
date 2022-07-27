<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function  get_all_Categories(){
        return Category::all();
    }

    public function category_get(Request $request)
    {
        $id = $request->id;
        $check = Category::where('id','=',$id)->first();
        if (!$check){
            return response(['message'=>'Not exist Category'], 401);
        }
        else{
            return response(['message'=>'Category exist','data'=>$check], 200);
        }
    }

    public  function  categories_create(Request $request){
        $name  = $request->name;
        $new_category = new Category();
        $check = Category::where('category_name','=',$name)->first();
        if ($check){
            return response(['message'=>'Duplicate Category'], 401);
        }
        $new_category->category_name = $name;
        $new_category->save();
        return response(['message'=>'Create Category Success'], 200);
    }
    public function categories_delete(Request $request){
        $category_id = $request->id;
        $book_check = Book::where('category_id','=',$category_id)->first();
        if ($book_check){
            return response(['message'=>'Category is used in another'], 401);
        }
        else{
            $check_first_delete = Category::where('id','=',$category_id)->first();
            if ($check_first_delete){

                $delete_result =  Category::where('id','=',$category_id)->delete();
                if ($delete_result){
                    return response(['message'=>'Delete Category Success'], 200);
                }
            }
        }
    }
    public function categories_update(Request $request){
        $category_id = $request->id;
        $updated_at = $request->updated_at;
       $category = Category::where('id','=',$category_id)->first();
       if (!$category){
           return response(['message'=>'Your Category is not exist'], 401);
       }
       if($category->updated_at !=$updated_at ){
           return response(['message'=>'Update Not Success . Have a Update Before'], 401);
       }
       else{
           $category->category_name = $request->name;
           $category->save();
           return response(['message'=>'Update Category Success'], 200);
       }
    }


}
