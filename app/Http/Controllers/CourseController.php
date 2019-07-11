<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use App\Jobs\SeedCourseTable;
use Illuminate\Support\Facades\Validator;
use App\Rules\UserRegisterCourse;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    public $course;

    /**
     * Create a new CourseController instance.
     *
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->message = null;
        $this->course = $course;
    }

    /**
     * return all courses in the system with registration indication.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->course->with(['users'])->paginate(10);
        $links = json_decode($courses->toJson());
        unset($links->data);
        $courseCollection =  CourseResource::collection($courses);
        $response = ["status" => "success", "message" => "Courses List", "data" => ["courses" => $courseCollection], 'links' => $links];
        return response($response, 200, ["Content-Type" => "application/json"]);
    }
    /**
     * User register courses
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function userRegister(Request $request)
    {
        $requestData = $request->all();

        $validator =  Validator::make($requestData, [
            'courses' => ['required', 'array', new UserRegisterCourse,],
        ]);
        if ($validator->fails()) {
            $response = ["status" => "error", "message" => "Registeration failed", "errors" => $validator->messages()];
            return response($response, 400, ["Content-Type" => "application/json"]);
        }
        $courses = $request->courses;
        $user = auth()->user();
        $user->courses()->syncWithoutDetaching($courses);
        $response = ["status" => "success", "message" => "Courses registeration success"];
        return response($response, 200, ["Content-Type" => "application/json"]);
    }

    /**
     * Seed Courses db table with 50 courses. 
     *
     * @return \Illuminate\Http\Response
     */
    public function seed()
    {
        //i use this $force_run_job  on heroku because i dont want to add my card to enable queue
        $force_run_job = config('app.force_run_job');
        if ($force_run_job) {
            factory(App\Course::class, 50)->create();
        } else {
            SeedCourseTable::dispatch();
        }
        $response = ["status" => "success", "message" => "Course seed job dispatched", "data" => []];
        return response($response, 200, ["Content-Type" => "application/json"]);
    }
}
