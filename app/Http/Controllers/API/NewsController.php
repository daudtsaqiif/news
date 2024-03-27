<?php

namespace App\Http\Controllers\API;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

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
            //validate
            $this->validate($request, [
                'title' => 'required',
                'category_id' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:9000',
                'content' => 'required'
            ]);
            
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/news', $image->hashName());
            
            //create data
            $news = News::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'category_id' => $request->category_id,
                'content' => $request->content,
                'image' => $image->hashName()
            ]);

            return ResponseFormatter::success([
                $news, 'Data news has been created'
            ]);


        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'massage' => 'something went worng',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

}
