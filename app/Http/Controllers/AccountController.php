<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;


class AccountController extends Controller
{
    public function registration()
    {
        return view('front.account.registration');
    }

    public function processRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->passes()) {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success', 'ลงทะเบียนเรียบร้อยแล้ว!');

            return response()->json([
                'status' => true,
                'error' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    // แสดงหน้า Login
    public function login()
    {
        return view('front.account.login');

    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'

        ]);

        if ($validator->passes()) {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('account.profile');
            } else {
                return redirect()->route('account.login')->with('error', 'อีเมลหรือรหัสผ่านไม่ถูกต้อง!');
            }
        } else {
            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    public function profile()
    {

        $id = Auth::user()->id;

        $user = User::where('id', $id)->first();

        return view('front.account.profile', [
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,' . $id = Auth::user()->id . ',id'
        ]);

        if ($validator->passes()) {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->save();

            session()->flash('success', 'อัปเดตโปรไฟล์เรียบร้อยแล้ว!');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }

    public function updateProfilePic(Request $request)
    {

        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'image' => 'required|image'
        ]);

        if ($validator->passes()) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $id . '.' . time() . '.' . $ext;
            $image->move(public_path('/profile_pic/'), $imageName);

            // Create a small thumbnail image
            $sourcePath = public_path('/profile_pic/' . $imageName);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($sourcePath);
            $image->cover(150, 150);
            $image->toPng()->save(public_path('/profile_pic/thumb/' . $imageName));

            // Delete Old Profile Pic
            File::delete(public_path('/profile_pic/thumb/' . Auth::user()->image));
            File::delete(public_path('/profile_pic/' . Auth::user()->image));



            User::where('id', $id)->update(['image' => $imageName]);

            session()->flash('success', 'อัปเดตรูปโปรไฟล์เรียบร้อยแล้ว!!');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function createJob()
    {

        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();

        $jobTypes = JobType::orderBy('name', 'ASC')->where('status', 1)->get();

        return view('front.account.job.create', [
            'categories' => $categories,
            'jobTypes' => $jobTypes,

        ]);
    }

    public function saveJob(Request $request)
    {
        // กำหนดกฎสำหรับการ validation
        $rules = [
            'title' => 'required|min:1|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'description' => 'required',
            'company_name' => 'required|min:1|max:75',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // ตรวจสอบไฟล์รูปภาพ
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->passes()) {
        
            // สร้างออบเจ็กต์ Job ใหม่
            $job = new Job();
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->user_id = Auth::user()->id;
            $job->vacancy = $request->vacancy;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
        
            // การอัพโหลดไฟล์ภาพ
            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->image->extension();  
                $request->image->move(public_path('job_pic'), $imageName);  // ย้ายไฟล์ไปที่ public/job_pic
                $job->job_image = 'job_pic/'.$imageName;  // บันทึก path ของภาพในฐานข้อมูล
            }
        
            $job->save();  // บันทึกข้อมูล
        
            session()->flash('success', 'เพิ่มสูตรอาหารเรียบร้อยแล้ว!');
        
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }    
    

    public function myJobs()
    {

        $jobs = Job::where('user_id', Auth::user()->id)->with('jobType')->orderBy('created_at', 'DESC')->paginate(10);

        return view('front.account.job.my-job', [
            'jobs' => $jobs
        ]);
    }

    public function editJob(Request $request, $id)
    {

        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();

        $jobTypes = JobType::orderBy('name', 'ASC')->where('status', 1)->get();

        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->first();

        if ($job == null) {
            abort(404);
        }
        return view('front.account.job.edit', [
            'categories' => $categories,
            'jobTypes' => $jobTypes,
            'job' => $job
        ]);
    }

    public function updateJob(Request $request, $id)
    {
        $rules = [
            'title' => 'required|min:1|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'description' => 'required',
            'company_name' => 'required|min:1|max:75',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // ตรวจสอบไฟล์รูปภาพ
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->passes()) {
        
            $job = Job::find($id);
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->user_id = Auth::user()->id;
            $job->vacancy = $request->vacancy;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
        
            // การอัพโหลดรูปภาพ
            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('job_pic'), $imageName);  // ย้ายไฟล์ไปที่ public/job_pic
                $job->job_image = 'job_pic/'.$imageName;  // บันทึก path ของภาพในฐานข้อมูล
            }
        
            $job->save();  // บันทึกข้อมูล
        
            session()->flash('success', 'อัปเดตสูตรอาหารเรียบร้อยแล้ว!');
        
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }      

    public function deleteJob(Request $request)
    {
        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $request->jobId
        ])->first();

        if ($job == null) {
            session()->flash('error', 'ไม่มีสูตรอาหารหรือถูกลบไปแล้ว!');
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        }

        Job::where('id', $job->id)->delete();
        session()->flash('success', 'ลบสูตรอาหารเรียบร้อยแล้ว!');
        return response()->json([
            'status' => true
        ]);
    }

    public function myJobApplications(Request $request)
    {
        $jobApplications = JobApplication::where('user_id', Auth::user()->id)
            ->with('job', 'job.jobType', 'job.jobApplications')
            ->paginate(10);


        return view('front.account.job.my-job-applications', [
            'jobApplications' => $jobApplications
        ]);
    }

    public function removeJobs(Request $request)
    {
        $jobApplication = JobApplication::where([
            'id' => $request->id,
            'user_id' => Auth::user()->id
        ])->first();
        if ($jobApplication == null) {
            session()->flash('error', 'ไม่พบสูตรอาหารที่บันทึก!');
            return response()->json([
                'status' => false,
                'message' => 'ไม่พบสูตรอาหารที่บันทึก.'
            ]);
        }

        JobApplication::find($request->id)->delete();

        session()->flash('success', 'ลบสูตรอาหารที่บันทึกเรียบร้อยแล้ว!');
        return response()->json([
            'status' => true,
            'message' => 'ลบสูตรอาหารที่บันทึกเรียบร้อยแล้ว.'
        ]);
    }
}
