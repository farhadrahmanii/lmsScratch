<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\CourseLecture;
use App\Models\CourseSection;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Category;
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
        return view('frontend.course.course_details', compact('course', 'courseGoal', 'sections', 'lectures', 'instructorCourses'));
    }// End Method
}
