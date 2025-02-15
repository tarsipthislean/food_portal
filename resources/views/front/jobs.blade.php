@extends('front.layouts.app')

@section('main')
    <section class="section-3 py-5 bg-2 ">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>ค้นหาสูตรอาหาร</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sort" id="sort" class="form-control">
                            <option value="1" {{ \Request::get('sort') == '1' ? 'selected' : '' }}>ล่าสุด</option>
                            <option value="0" {{ \Request::get('sort') == '0' ? 'selected' : '' }}>เก่าแก่ที่สุด
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <form action="" name="searchForm" id="searchForm">
                        <div class="card border-0 shadow p-4">
                            <div class="mb-4">
                                <h2>คีย์เวิร์ดสูตรอาหาร</h2>
                                <input value="{{ \Request::get('keyword') }}" type="text" name="keyword" id="keyword"
                                    placeholder="คีย์เวิร์ดอาหาร" class="form-control">
                            </div>

                            <div class="mb-4">
                                <h2>ที่อยู่สูตรอาหาร</h2>
                                <input value="{{ \Request::get('location') }}" type="text" name="location" id="location"
                                    placeholder="ต้นกำเนิดอาหาร เช่น บุรีรัมย์" class="form-control">
                            </div>

                            <div class="mb-4">
                                <h2>หมวดหมู่สูตรอาหาร</h2>
                                <select name="category" id="category" class="form-control">
                                    <option value="">เลือกหมวดหมู่</option>
                                    @if ($categories->isNotEmpty())
                                        @foreach ($categories as $category)
                                            <option {{ \Request::get('category') == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="mb-4">
                                <h2>ประเภทสูตรอาหาร</h2>

                                @if ($jobTypes->isNotEmpty())
                                    @foreach ($jobTypes as $jobType)
                                        <div class="form-check mb-2">
                                            <input {{ in_array($jobType->id, $jobTypeArray) ? 'checked' : '' }}
                                                class="form-check-input " name="job_type" type="checkbox"
                                                value="{{ $jobType->id }}" id="job-type-{{ $jobType->id }}">
                                            <label class="form-check-label "
                                                for="job-type-{{ $jobType->id }}">{{ $jobType->name }}</label>
                                        </div>
                                    @endforeach
                                @endif

                            </div>

                            <div class="mb-4">
                                <h2>อายุสูตรอาหาร</h2>
                                <select name="experience" id="experience" class="form-control">
                                    <option value="">เลือกอายุสูตรอาหาร</option>
                                    <option value="1" {{ \Request::get('experience') == 1 ? 'selected' : '' }}>1
                                        ปี</option>
                                    <option value="2" {{ \Request::get('experience') == 2 ? 'selected' : '' }}>2
                                        ปี</option>
                                    <option value="3" {{ \Request::get('experience') == 3 ? 'selected' : '' }}>3
                                        ปี</option>
                                    <option value="4" {{ \Request::get('experience') == 4 ? 'selected' : '' }}>4
                                        ปี</option>
                                    <option value="5" {{ \Request::get('experience') == 5 ? 'selected' : '' }}>5
                                        ปี</option>
                                    <option value="6" {{ \Request::get('experience') == 6 ? 'selected' : '' }}>6
                                        ปี</option>
                                    <option value="7" {{ \Request::get('experience') == 7 ? 'selected' : '' }}>7
                                        ปี</option>
                                    <option value="8" {{ \Request::get('experience') == 8 ? 'selected' : '' }}>8
                                        ปี</option>
                                    <option value="9" {{ \Request::get('experience') == 9 ? 'selected' : '' }}>9
                                        ปี</option>
                                    <option value="10" {{ \Request::get('experience') == 10 ? 'selected' : '' }}>10
                                        ปี</option>
                                    <option value="10_plus"
                                        {{ \Request::get('experience') == '10_plus' ? 'selected' : '' }}>10+ ปี
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">ค้นหาสูตรอาหาร</button>
                            <a href="{{ route('jobs') }}" class="btn btn-primary mt-3">รีเฟรช</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 col-lg-9 ">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                                @if ($jobs->isNotEmpty())
                                    @foreach ($jobs as $job)
                                        <div class="col-md-4">
                                            <div class="card border-0 p-3 shadow mb-4">
                                                <div class="card-body">
                                                    <!-- Title -->
                                                    <h3 class="border-0 fs-5 pb-2 mb-0 fw-bolder" style="font-weight: 800;">
                                                        {{ $job->title }}</h3>

                                                    <!-- Description -->
                                                    <p>{{ Str::words($job->description, $words = 10, '...') }}</p>

                                                    <!-- Job Image -->
                                                    <div class="bg-light p-3 border">
                                                        <div class="image-container">
                                                            @if ($job->job_image)
                                                                <img src="{{ asset($job->job_image) }}" alt="Job Image"
                                                                    class="img-fluid"
                                                                    style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                                                            @else
                                                                <span>ไม่มีรูปภาพที่แสดง</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Details Button -->
                                                    <div class="d-grid mt-3">
                                                        <a href="{{ route('jobDetail', $job->id) }}"
                                                            class="btn btn-primary btn-lg">รายละเอียด</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12">ไม่พบสูตรอาหาร</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();


            var url = '{{ route('jobs') }}?';

            var keyword = $('#keyword').val();
            var location = $('#location').val();
            var category = $('#category').val();
            var experience = $('#experience').val();
            var sort = $('#sort').val();

            var checkedJobType = $("input:checkbox[name='job_type']:checked").map(function() {
                return $(this).val();
            }).get();

            // If keyword has a value
            if (keyword != "") {
                url += '&keyword=' + keyword;
            }

            // If location has a value
            if (location != "") {
                url += '&location=' + location;
            }

            // If category has a value
            if (category != "") {
                url += '&category=' + category;
            }

            // If experience has a value
            if (experience != "") {
                url += '&experience=' + experience;
            }
            // If user has checked job types
            if (checkedJobType.length > 0) {
                checkedJobType.forEach(function(type) {
                    url += '&job_type[]=' + type;
                });
            }

            url += '&sort=' + sort;


            window.location.href = url;
        });

        $('#sort').change(function() {
            $('#searchForm').submit();
        })
    </script>
@endsection
