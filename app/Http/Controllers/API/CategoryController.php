<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //
    public function index()
    {
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
    public function show($id)
    {
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
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|unique:categories',
                'image' => 'required|image|mimes:jpeg,jpg,png|max:9000'
            ]);

            //store image
            $image = $request->file('image');
            $image->storeAs('public/category', $image->hashName());

            //store data
            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $image->hashName()
            ]);

            return ResponseFormatter::success(
                $category,
                'Data category Berhasil Ditambah'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'massage' => 'something went worng',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'image' => 'image|mimes:jpg,png,jpeg'
            ]);

            //get category by id
            $category = Category::findOrFail($id);

            //storage image
            if ($request->file('image') == '') {
                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name)
                ]);
            } else {
                //jika gambarnya pengen di update hapus image lama
                Storage::disk('local')->delete('public/category/' . basename($category->image));

                //upload image baru
                $image = $request->file('image');
                $image->storeAs('public/category/', $image->hashName());

                //update data

                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'image' => $image->hashName()
                ]);
            }

            return ResponseFormatter::success([
                $category,
                'data category berhasil di update'
            ]);

        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'massage' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function destroy($id){
        try {
            //get data by id
            $category = Category::findOrFail($id);
            //delet image
            Storage::disk('local')->delete('public/category' . basename($category->image));

            //delet data
            $category->delete();

            return ResponseFormatter::success([
                null,
                'data category berhasil dihapus'
            ]);

        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'massage' => 'something went worng',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
}
