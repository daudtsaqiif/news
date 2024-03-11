<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'News - Index';
        
        //get data terbaru dari table news/dari model news
        $news = News::latest()->paginate(5);
        $category = Category::all();
        
        return view('home.news.index', compact('title', 'news', 'category') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'News - Create';

        $category = Category::all();
        return view('home.news.create', compact('title', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:900000',
            'content' =>'required',
            'category_id' => 'required',
        ]);

        //upload image
        $image = $request->file('image');
        //fungsi untuk menyimpan image ke dalam folder public/news
        //fungsi hashName() untuk memberikan nama acak pada image
        $image->storeAs('public/news/', $image->hashName());

        //create data ke dalam table news
        News::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'image' => $image->hashName(),
            'content' => $request->content
        ]);

        return redirect()->route('news.index') ->with(['success' => 'News Berhasil di buat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $title = 'News - Show';

        //get data by id using model news
        //fungsi dari findorfail adalah jika data tidak di teamukan maka akan menampilkan error
        $news = News::findOrFail($id);


        return view('home.news.show', compact('title', 'news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $news = News::findOrFail($id);
        $category = Category::all();
        $title = 'News - Edit';

        return view('home.news.edit', compact('title', 'category', 'news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png|max:9000'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
