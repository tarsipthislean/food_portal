<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    #this method will show our home
    public function index()
    {
        $categories = Category::where('status', 1)->orderBy('name', 'ASC')->take(8)->get();

        // ดึงจำนวนตำแหน่งงานที่เปิดรับในแต่ละ category
        foreach ($categories as $category) {
            $category->available_positions = Job::where('category_id', $category->id)
                ->where('status', 1)
                ->count();
        }

        $newCategories = Category::where('status', 1)->orderBy('name', 'ASC')->get();

        $featuredJobs = Job::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->with('jobType')
            ->where('isFeatured', 1)
            ->take(6)->get();

        $latestJobs = Job::where('status', 1)
            ->with('jobType')
            ->orderBy('created_at', 'DESC')
            ->take(6)->get();

        return view('front.home', [
            'categories' => $categories,
            'featuredJobs' => $featuredJobs,
            'latestJobs' => $latestJobs,
            'newCategories' => $newCategories,
        ]);
    }
}
