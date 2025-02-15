@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">โพสต์สูตรอาหาร</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('front.account.sidebar')
                </div>
                <div class="col-lg-9">
                    @include('front.message')

                    <form action="" method="post" id="createJobForm" name="createJobForm"
                        enctype="multipart/form-data">
                        <div class="card border-0 shadow mb-4 ">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">สร้างโพสต์อาหาร</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">ชื่ออาหาร<span class="req">*</span></label>
                                        <input type="text" placeholder="ชื่ออาหาร" id="title" name="title"
                                            class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">หมวดหมู่อาหาร<span
                                                class="req">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">เลือกหมวดหมู่อาหาร</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">ประเภทสูตรอาหาร<span
                                                class="req">*</span></label>
                                        <select name="jobType" id="jobType" class="form-select">
                                            <option value="">ประเภทสูตรอาหาร</option>
                                            @if ($jobTypes->isNotEmpty())
                                                @foreach ($jobTypes as $jobType)
                                                    <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">จำนวนสูตรอาหาร<span
                                                class="req">*</span></label>
                                        <input type="number" min="1" placeholder="จำนวนสูตรอาหาร" id="vacancy"
                                            name="vacancy" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">ต้นกำเนิดสูตรอาหาร<span class="req">*</span></label>
                                        <input type="text" placeholder="ต้นกำเนิดสูตรอาหาร" id="location" name="location"
                                            class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">แนะนำสูตรอาหาร<span class="req">*</span></label>
                                    <textarea class="form-control" name="description" id="description" cols="5" rows="5"
                                        placeholder="แนะนำสูตรอาหาร"></textarea>
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">สูตรอาหาร</label>
                                    <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="สูตรอาหาร"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">อายุสูตรอาหาร <span class="req">*</span></label>
                                    <select name="experience" id="experience" class="form-control">
                                        <option value="1">1 ปี</option>
                                        <option value="2">2 ปี</option>
                                        <option value="3">3 ปี</option>
                                        <option value="4">4 ปี</option>
                                        <option value="5">5 ปี</option>
                                        <option value="6">6 ปี</option>
                                        <option value="7">7 ปี</option>
                                        <option value="8">8 ปี</option>
                                        <option value="9">9 ปี</option>
                                        <option value="10">10 ปี</option>
                                        <option value="10_plus">10+ ปี</option>
                                    </select>
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">คีย์เวิร์ดสูตรอาหาร</label>
                                    <input type="text" placeholder="คีย์เวิร์ดสูตรอาหาร" id="keywords" name="keywords"
                                        class="form-control">
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">แนบรูปสูตรอาหาร</label>
                                    <input type="file" name="image" class="form-control" id="imageInput"
                                        onchange="previewImage(event)">
                                    <!-- แสดงตัวอย่างภาพที่เลือก -->
                                    <img id="imagePreview" src="#" alt="Image Preview"
                                        style="width: 300px; height: 300px; object-fit: cover; margin-top: 10px;">
                                </div>



                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">ข้อมูลติดต่อ</h3>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">ชื่อผู้ใช้<span class="req">*</span></label>
                                        <input type="text" placeholder="ชื่อผู้ใช้" id="company_name"
                                            name="company_name" class="form-control">
                                        <p></p>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">อีเมลล์</label>
                                        <input type="text" placeholder="อีเมลล์" id="company_location"
                                            name="company_location" class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer p-4">
                                <button type="submit" class="btn btn-primary">บันทึกสูตรอาหาร</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    
@endsection


@section('customJs')
    <script type="text/javascript">
        // ฟังก์ชันแสดงตัวอย่างภาพที่เลือก
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('imagePreview');
                output.src = reader.result; // กำหนดให้แสดงตัวอย่างภาพที่เลือก
            }
            reader.readAsDataURL(event.target.files[0]); // อ่านไฟล์ที่เลือก
        }

        $("#createJobForm").submit(function(e) {
            e.preventDefault();
            $("button[type='submit']").prop('disabled', true);
            $.ajax({
                url: '{{ route('account.saveJob') }}',
                type: 'POST',
                dataType: 'json',
                data: new FormData($("#createJobForm")[0]), // ส่งข้อมูลฟอร์มรวมถึงไฟล์
                contentType: false, // ไม่ต้องส่ง Content-Type
                processData: false, // ไม่ต้องแปลงข้อมูล
                success: function(response) {
                    $("button[type='submit']").prop('disabled', false);

                    if (response.status == true) {
                        $('#title').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#category').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#jobType').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#vacancy').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#location').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#description').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#company_name').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        window.location.href = "{{ route('account.myJobs') }}";
                    } else {
                        var error = response.errors;

                        if (error.title) {
                            $('#title').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(error.title);
                        } else {
                            $('#title').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (error.category) {
                            $('#category').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(error.category);
                        } else {
                            $('#category').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (error.jobType) {
                            $('#jobType').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(error.jobType);
                        } else {
                            $('#jobType').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (error.vacancy) {
                            $('#vacancy').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(error.vacancy);
                        } else {
                            $('#vacancy').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (error.location) {
                            $('#location').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(error.location);
                        } else {
                            $('#location').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (error.description) {
                            $('#description').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(error.description);
                        } else {
                            $('#description').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (error.company_name) {
                            $('#company_name').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(error.company_name);
                        } else {
                            $('#company_name').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                    }
                }
            });
        });
    </script>
@endsection
