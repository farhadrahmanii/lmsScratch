<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\Course_goal;
use App\Models\CourseLecture;
use App\Models\CourseSection;
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
            'video' => $videoPath,
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
        $goals = Course_goal::where('course_id', $id)->get();
        $category = Category::latest()->get();
        $subcategory = subCategory::latest()->get();
        return view('instructor.courses.edit', compact('course', 'subcategory', 'category', 'goals'));
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
    public function Destory($id)
    {
        $course = Course::findOrFail($id);
        unlink($course->course_image);
        unlink($course->video);
        $course->delete();

        $goalsData = Course_goal::where('course_id', $id)->get();
        foreach ($goalsData as $goal) {

            $goal->delete();
        }
        $notification = array(
            'message' => 'Course Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // Update Course Image 
    public function UpdateCourseImage(Request $request)
    {
        $course_image = $request->file('course_image');
        $name_gen = hexdec(uniqid()) . '.' . $course_image->getClientOriginalExtension();
        $course_image = Image::read($course_image->path());
        $course_image->resize(370, 246);
        $save_url = 'upload/course/thumbnail/' . $name_gen;
        $course_image->save($save_url);

        Course::findOrFail($request->course_id)->update([
            'course_image' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
        if ($request->old_image) {
            unlink($request->old_image);
        }

        $notification = array(
            'message' => 'Course Image Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.courses')->with($notification);
    }
    public function UpdateCourseVideo(Request $request)
    {
        $video = $request->file('video');
        $name_gen = hexdec(uniqid()) . '.' . $video->getClientOriginalExtension();
        $save_url = 'upload/course/video/' . $name_gen;

        // Move the video file to the designated path
        $video->move(public_path('upload/course/video'), $name_gen);

        // Update the course with the new video path
        Course::findOrFail($request->course_id)->update([
            'video' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
        // Delete the old video file if it exists
        if ($request->old_video) {
            if (file_exists(public_path($request->old_video))) {
                unlink(public_path($request->old_video));
            }
        }

        $notification = array(
            'message' => 'Course Video Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function UpdateCourseGoal(Request $request)
    {
        if ($request->course_goals == null) {
            return redirect()->back()->with('error', 'No Course Goals Found');
        } else {
            Course_goal::where('course_id', $request->id)->delete();

            if ($request->course_goals) {
                foreach ($request->course_goals as $goal) {
                    Course_goal::create([
                        'course_id' => $request->id,
                        'goal_name' => $goal,
                    ]);
                }
            }
        }

        $notification = array(
            'message' => 'Course Goals are Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // Course section and lecture 
    public function AddCourseLecture($id)
    {
        $course = Course::findOrFail($id);
        $courseSection = CourseSection::where('course_id', $id)->get();
        return view('instructor.courses.section.addCourseLecture ', compact('course', 'courseSection'));
    }
    public function AddCourseSection(Request $request)
    {
        $course = Course::findOrFail($request->course_id);

        if ($course) {
            CourseSection::insert([
                'course_id' => $request->course_id,
                'section_title' => $request->section_title,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Course Section Inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Course Not Found',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

    }
    public function SaveLecture(Request $request)
    {
        $lecture = new CourseLecture();
        $lecture->course_id = $request->course_id;
        $lecture->section_id = $request->section_id;
        $lecture->lecture_title = $request->lecture_title;
        $lecture->content = $request->content;
        $lecture->url = $request->url;
        $lecture->save();

        $notification = array(
            'message' => 'Lecture is saved successfully',
            'alert-type' => 'success'
        );
        return response()->json(['success' => 'Lecture is saved successfully']);

    }
    public function EditLecture($id)
    {
        $clecture = CourseLecture::findOrFail($id);
        return view('instructor.courses.lecture.edit_course_lecture', compact('clecture'));
    }
    public function UpdateourseLecture(Request $request)
    {
        $lid = $request->id;
        CourseLecture::findOrFail($lid)->update([
            'lecture_title' => $request->lecture_title,
            'content' => $request->content,
            'url' => $request->url,
        ]);
        $notification = array(
            'message' => 'Course Lecture Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function DeleteLecture($id)
    {
        CourseLecture::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Course Lecture Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function DeleteSection($id)
    {
        $sectionId = CourseSection::findOrFail($id);
        // Delete All Related Lectures

        $sectionId->lectures()->delete();
        // Delete Section
        $sectionId->delete();
        $notification = array(
            'message' => 'Course Section Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

}