<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::latest()->get();

        return view('admin.backend.category.index', ['category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image = Image::read($image->path());

        $image->resize(370, 246);
        $save_url = 'upload/category/' . $name_gen;
        $image->save($save_url);

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '_', $request->category_name)),
            'image' => $save_url
        ]);

        $notification = [
            'message' => 'Category Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.category')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Category::findOrFail($id);
        return view('admin.backend.category.edit', ['category' => $id]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        if ($request->file('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image = Image::read($image->path());

            $image->resize(370, 246);
            $save_url = 'upload/category/' . $name_gen;
            $image->save($save_url);
            Category::findOrFail($id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '_', $request->category_name)),
                'image' => $save_url
            ]);

            $notification = [
                'message' => 'Category Updated Successfully',
                'alert-type' => 'success'
            ];
            return redirect()->route('all.category')->with($notification);
        } else {
            Category::findOrFail($id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '_', $request->category_name)),
            ]);

            $notification = [
                'message' => 'Category Updated Successfully',
                'alert-type' => 'success'
            ];
            return redirect()->route('all.category')->with($notification);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Category::findOrFail($id);
        $img = $item->image;
        unlink($img);
        Category::findOrFail($id)->delete();

        $notification = [
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
    /////////////////////////////////////// Sub Category start here
    public function AllSubCategory()
    {
        $subcategory = SubCategory::latest()->get();

        return view('admin.backend.subcategory.index', ['subcategory' => $subcategory]);
    }

    public function CreateSubCategory()
    {
        $category = Category::latest()->get();

        return view('admin.backend.subcategory.create', ['category' => $category]);
    }

    public function StoreSubCategory(Request $request)
    {
        // $request->validate([
        //     'category_id' => ['required', 'integer'],
        //     'subcategory_name' => ['required'],
        // ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '_', $request->subcategory_name)),
        ]);

        $notification = [
            'message' => 'SubCategory Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.subcategory')->with($notification);
    }
    public function editSubCategory($id)
    {
        $category = Category::latest()->get();
        $subcategory = SubCategory::findOrFail($id);

        return view('admin.backend.subcategory.edit', ['category' => $category, 'subcategory' => $subcategory]);

    }

    public function updateSubCategory(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'integer'],
            'subcategory_name' => ['required'],
        ]);

        SubCategory::findOrFail($request->id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '_', $request->subcategory_name)),
        ]);
        $notification = [
            'message' => 'SubCategory Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.subcategory')->with($notification);

    }

    public function destroySubCategory($id)
    {
        SubCategory::findOrFail($id)->delete();

        $notification = [
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
