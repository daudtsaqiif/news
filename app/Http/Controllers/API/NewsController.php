<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function index(){
        try {
            $news = News::latest()->get();
            return ResponseFormatter::success([
                $news, 'Data list of news'
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
            $news = News::findOrFail($id);
            return ResponseFormatter::success([
                $news, 'Data news by id'
            ]);
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'massage' => 'Something went worng',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
    public function store(Request $request){
        try {
            //code...
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'massage' => 'something went worng',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

}
