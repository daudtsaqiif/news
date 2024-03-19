<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index(){

        //get data category
        $category = Category::latest()->get();

        //\
        $sliderNews = News::latest()->limit(3)->get();

        

        return view('frontend.news.index', compact('category', 'sliderNews'));
    }

    public function detailNews($slug){
        //data by category
        $category = Category::latest()->get();

        //data news by slug
        $news = News::where('slug', $slug)->first();
        
        $allCategory = News::get();

        return view('frontend.news.detail', compact('category', 'news', 'allCategory'));
    }

    public function detailCategory($slug){
        $category = Category::latest()->get();

        $detailCategory = Category::where('slug', $slug)->first();

        $news = News::where('category_id', $detailCategory->id)->latest()->get();

        return view('frontend.news.detail-category', compact('category', 'detailCategory', 'news'));
    }

    
}
