<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories(Request $request)
{
    $all_categories = Category::get()->all();
    if($all_categories)
    {
        return response()->json(['all_categories' => $all_categories]);
    }
    else
    {
        return response()->json(['all_categories' => []]);
    }
}
    public function __construct()
    {
        $this->middleware('auth:api_user');
    }

}
