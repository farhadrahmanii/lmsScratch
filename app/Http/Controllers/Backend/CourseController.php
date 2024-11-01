<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\Course_goal;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;
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
        $request->validate([
            'video' => ['required'],
        ]);
        $image = $request->file('course_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image = Image::read($image->path());
        $image->resize(370, 246);
        $save_url = 'upload/course/thumbnail/' . $name_gen;
        $image->save($save_url);


        $video = $request->file('video');
        $videoName = time() . '.' . $video->getClientOriginalExtension();
        $videoPath = 'upload/course/video/' . $videoName;
        $video->move(public_path('upload/course/video'), $videoName);


        $course = Course::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => Auth::user()->id,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'course_title' => $request->course_title,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->selling_price,
            'label' => $request->label,
            'duration' => $request->duration,
            'description' => $request->description,
            'certificate' => $request->certificate,
            'resources' => $request->resources,
            'prerequisites' => $request->prerequisites,
            'highestrated' => $request->highestrated,
            'featured' => $request->featured,
            'bestseller' => $request->bestseller,
            'status' => 1,
            'course_image' => $save_url,
            'video' => $save_url,
            'created_at' => Carbon::now(),

        ]);


        if ($request->course_goals) {
            foreach ($request->course_goals as $goal) {
                Course_goal::create([
                    'course_id' => $course,
                    'goal_name' => $goal,
                ]);
            }
        }

        $notification = array(
            'message' => 'Course Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.courses')->with($notification);
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
    public function EditCourse($id)
    {
        $course = Course::findOrFail($id);
        $category = Category::latest()->get();
        $subcategory = subCategory::latest()->get();
        return view('instructor.courses.edit', compact('course', 'subcategory', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateCourse(Request $request)
    {

        $cid = $request->course_id;
        Course::findOrFail($cid)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => Auth::user()->id,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'course_title' => $request->course_title,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'label' => $request->label,
            'duration' => $request->duration,
            'description' => $request->description,
            'certificate' => $request->certificate,
            'resources' => $request->resources,
            'prerequisites' => $request->prerequisites,
            'highestrated' => $request->highestrated,
            'featured' => $request->featured,
            'bestseller' => $request->bestseller,
            'status' => 1,
        ]);


        $notification = array(
            'message' => 'Course Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.courses')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
