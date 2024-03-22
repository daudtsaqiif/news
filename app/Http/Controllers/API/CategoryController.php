<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){
        try {
            //get all category
        $category = Category::latest()->get();
        return ResponseFormatter::success([
            $category, 'Data category Berhasil di ambil'
        ]);
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'massage' => 'Something went worng',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
    public function show($id){
        try {
            //get data by id
            $category = Category::findOrFail($id);
            return ResponseFormatter::success([
                $category, 'Data category by id'
            ]);
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'massage' => 'Something went worng',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
}
