<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AllCourse()
    {
        $id = Auth::user()->id;
        $course = Course::where('instructor_id', $id)->orderBy('id', 'desc')->get();

        return view('instructor.courses.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddCourse()
    {
        $category = Category::latest()->get();

        return view('instructor.courses.create', compact('category'));
    }
    // get Sub Category 
    public function GetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();

        return json_encode($subcat);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function StoreCourse(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
