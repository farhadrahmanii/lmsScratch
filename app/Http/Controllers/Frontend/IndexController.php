<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\CourseLecture;
use App\Models\CourseSection;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class IndexController extends Controller
{
    public function CourseDetails($id, $slug)
    {
        $course = Course::findOrFail($id);
        $courseGoal = Course_goal::where('course_id', $id)->orderBy('id', 'DESC')->get();
        $sections = CourseSection::where('course_id', $id)->with([
            'lectures' => function ($query) {
                $query->orderBy('id', 'DESC');
            }
        ])->get();
        $lectures = CourseLecture::where('course_id', $id)->orderBy('id', 'DESC')->get();
        $ins_id = $course->instructor_id;
        $instructorCourses = Course::where('instructor_id', $ins_id)->orderBy('id', 'DESC')->get();
        $categories = Category::latest()->get();
        $category_courses = Course::where('category_id', $course->category_id)->where('id', '!=', $id)->limit(3)->get();
        return view('frontend.course.course_details', compact('course', 'courseGoal', 'category_courses', 'sections', 'categories', 'lectures', 'instructorCourses'));
    }// End Method

    public function CourseCategory($id, $slug)
    {
        $courses = Course::where('category_id', $id)->where('status', 1)->latest()->get();
        $category = Category::where('id', $id)->first();
        $categories = Category::latest()->get();

        return view('frontend.category.category_all', compact('courses', 'category', 'categories'));
    }// End Method
    public function CourseSubCategory($id, $slug)
    {
        $courses = Course::where('subcategory_id', $id)->where('status', 1)->latest()->get();
        $subcategory = SubCategory::where('id', $id)->first();
        $categories = Category::latest()->get();

        return view('frontend.category.subcategory_all', compact('courses', 'subcategory', 'categories'));
    }// End Method

    public function InstructorDetails($id)
    {
        $instructor = User::findOrFail($id);
        $ins_courses = Course::where('instructor_id', $id)->latest()->limit(6)->get();

        return view('frontend.instructor.instructor_details', compact('instructor', 'ins_courses'));
    }// End Method

}
