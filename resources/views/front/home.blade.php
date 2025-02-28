@extends('front.layouts.app')

@section('main')
    <section class="section-0 lazy d-flex bg-image-style dark align-items-center"
        style="background-image: url('{{ asset('assets/images/background1.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-8">
                    <h1>ค้นหาสูตรอาหารทั่วโลก</h1>
                    <p>มีสูตรอาหารให้เลือกมากมายดูได้แล้วที่นี่.</p>
                    <div class="banner-btn mt-5"><a href="{{ route('jobs') }}"
                            class="btn btn-primary mb-4 mb-sm-0">สำรวจเลย</a></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-1 py-5 ">
        <div class="container">
            <div class="card border-0 shadow p-5">
                <form action="{{ route('jobs') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <input type="text" class="form-control" name="keyword" id="keyword"
                                placeholder="คีย์เวิร์ดอาหารหาร">
                        </div>
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <input type="text" class="form-control" name="location" id="location"
                                placeholder="ต้นตำรับสูตรอาหาร">
                        </div>
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <select name="category" id="category" class="form-control">
                                <option value="">เลือกหมวดหมู่อาหาร</option>
                                @if ($newCategories->isNotEmpty())
                                    @foreach ($newCategories as $newCategory)
                                        <option value="{{ $newCategory->id }}">{{ $newCategory->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class=" col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                            <div class="d-grid gap-2">
                                {{-- <a href="{jobs.html}" class="btn btn-primary btn-block">Search</a> --}}
                                <button type="submit" class="btn btn-primary btn-block">ค้นหาสูตรอาหาร</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="section-2 bg-2 py-5">
        <div class="container">
            <h2>หมวดหมู่ยอดนิยม</h2>
            <div class="row pt-5">

                @if ($categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <div class="col-lg-4 col-xl-3 col-md-6">
                            <div class="single_catagory">
                                <a href="{{ route('jobs') . '?category=' . $category->id }}">
                                    <h4 class="pb-2 font-extrabold">{{ $category->name }}</h4>
                                </a>

                                <p class="mb-0">มีสูตรอาหารทั้งหมด <span>{{ $category->available_positions }}</span> สูตร
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>


    <section class="section-3 py-5">
        <div class="container">
            <h2>สูตรอาหารแนะนำ</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @if ($featuredJobs->isNotEmpty())
                                @foreach ($featuredJobs as $featuredJob)
                                    <div class="col-md-4">
                                        <div class="card border-0 p-3 shadow mb-4">
                                            <div class="card-body">
                                                <h3 class="border-0 fs-5 pb-2 mb-0 fw-bolder" style="font-weight: 800;">
                                                    {{ $featuredJob->title }}</h3>

                                                <p>{{ Str::words($featuredJob->description, 5) }}</p>

                                                <!-- แสดงภาพจาก job_image -->
                                                <div class="bg-light p-3 border">
                                                    <div class="image-container">
                                                        <!-- แสดงภาพ job_image -->
                                                        @if ($featuredJob->job_image)
                                                            <img src="{{ asset($featuredJob->job_image) }}" alt="Job Image"
                                                                class="img-fluid"
                                                                style="width: 100%; height: 300px; object-fit: cover; border-radius: 8px;">
                                                        @else
                                                            <span>ไม่มีรูปภาพสูตรอาหาร</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('jobDetail', $featuredJob->id) }}"
                                                        class="btn btn-primary btn-lg">รายละเอียด</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h2>สูตรอาหารไหม่ล่าสุด</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @if ($latestJobs->isNotEmpty())
                                @foreach ($latestJobs as $latestJob)
                                    <div class="col-md-4">
                                        <div class="card border-0 p-3 shadow mb-4">
                                            <div class="card-body">
                                                <h3 class="border-0 fs-5 pb-2 mb-0 fw-bolder" style="font-weight: 800;">
                                                    {{ $latestJob->title }}</h3>

                                                <p>{{ Str::words($latestJob->description, 5) }}</p>

                                                <!-- แสดงภาพจาก job_image -->
                                                <div class="bg-light p-3 border">
                                                    <div class="image-container">
                                                        <!-- แสดงภาพ job_image -->
                                                        @if ($latestJob->job_image)
                                                            <img src="{{ asset($latestJob->job_image) }}" alt="Job Image"
                                                                class="img-fluid"
                                                                style="width: 100%; height: 300px; object-fit: cover; border-radius: 8px;">
                                                        @else
                                                            <span>No image available</span>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('jobDetail', $latestJob->id) }}"
                                                        class="btn btn-primary btn-lg">รายละเอียด</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
