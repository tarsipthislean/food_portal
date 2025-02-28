@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">แก้ไขสูตรอาหารของฉัน</li>
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

                    <form action="" method="post" id="editJobForm" name="editJobForm">
                        <div class="card border-0 shadow mb-4 ">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">แก้ไขสูตรอาหารของฉัน</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">ชื่อสูตรอาหาร<span
                                                class="req">*</span></label>
                                        <input value="{{ $job->title }}" type="text" placeholder="ชื่อสูตรอาหาร"
                                            id="title" name="title" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">หมวดหมู่อาหาร<span
                                                class="req">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">เลือกหมวดหมู่อาหาร</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option {{ $job->category_id == $category->id ? 'selected' : '' }}
                                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">ประเภทอาหาร<span
                                                class="req">*</span></label>
                                        <select name="jobType" id="jobType" class="form-select">
                                            <option value="">เลือกประเภทอาหาร</option>
                                            @if ($jobTypes->isNotEmpty())
                                                @foreach ($jobTypes as $jobType)
                                                    <option {{ $job->job_type_id == $jobType->id ? 'selected' : '' }}
                                                        value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">จำนวนสูตรอาหาร<span
                                                class="req">*</span></label>
                                        <input value="{{ $job->vacancy }}" type="number" min="1"
                                            placeholder="จำนวนสูตรอาหาร" id="vacancy" name="vacancy" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">ต้นตำรับสูตรอาหาร<span
                                                class="req">*</span></label>
                                        <input value="{{ $job->location }}" type="text"
                                            placeholder="ต้นตำรับสูตรอาหาร เช่น บุรีรัมย์" id="location" name="location"
                                            class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">แนะนำสูตรอาหาร<span class="req">*</span></label>
                                    <textarea class="form-control" name="description" id="description" cols="5" rows="5"
                                        placeholder="แนะนำสูตรอาหาร">{{ $job->description }}</textarea>
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">สูตรอาหาร</label>
                                    <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="สูตรอาหาร">{{ $job->benefits }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">อายุสูตรอาหาร <span class="req">*</span>
                                    </label>
                                    <select name="experience" id="experience" class="form-control">
                                        <option value="1" {{ $job->experience == '1' ? 'selected' : '' }}>1 ปี
                                        </option>
                                        <option value="2" {{ $job->experience == '2' ? 'selected' : '' }}>2 ปี
                                        </option>
                                        <option value="3" {{ $job->experience == '3' ? 'selected' : '' }}>3 ปี
                                        </option>
                                        <option value="4" {{ $job->experience == '4' ? 'selected' : '' }}>4 ปี
                                        </option>
                                        <option value="5" {{ $job->experience == '5' ? 'selected' : '' }}>5 ปี
                                        </option>
                                        <option value="6" {{ $job->experience == '6' ? 'selected' : '' }}>6 ปี
                                        </option>
                                        <option value="7" {{ $job->experience == '7' ? 'selected' : '' }}>7 ปี
                                        </option>
                                        <option value="8" {{ $job->experience == '8' ? 'selected' : '' }}>8 ปี
                                        </option>
                                        <option value="9" {{ $job->experience == '9' ? 'selected' : '' }}>9 ปี
                                        </option>
                                        <option value="10" {{ $job->experience == '10' ? 'selected' : '' }}>10 ปี
                                        </option>
                                        <option value="10_plus" {{ $job->experience == '10_plus' ? 'selected' : '' }}>
                                            10+ ปี</option>
                                    </select>
                                    <p></p>
                                </div>


                                <div class="mb-4">
                                    <label for="" class="mb-2">คีย์เวิร์ดสูตรอาหาร</label>
                                    <input value="{{ $job->keywords }}" type="text" placeholder="คีย์เวิร์ดสูตรอาหาร"
                                        id="keywords" name="keywords" class="form-control">
                                </div>
                                <!-- ส่วนการอัพโหลดและแสดงตัวอย่างภาพ -->
                                <div class="mb-4">
                                    <label for="" class="mb-2">แนบรูปสูตรอาหาร</label>
                                    <input type="file" name="image" class="form-control" id="imageInput"
                                        onchange="previewImage(event)">

                                    <!-- แสดงตัวอย่างภาพที่เลือก -->
                                    <img id="imagePreview" src="{{ asset($job->job_image) }}" alt="Current Image"
                                        style="max-width: 300px; max-height: 300px; object-fit: cover; margin-top: 10px;">
                                </div>


                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">ข้อมูลติดต่อ</h3>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">ชื่อผู้ใช้<span
                                                class="req">*</span></label>
                                        <input value="{{ $job->credit_name }}" type="text" placeholder="ชื่อผู้ใช้"
                                            id="credit_name" name="credit_name" class="form-control">
                                        <p></p>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">อีเมลล์</label>
                                        <input value="{{ $job->credit_email }}" type="text" placeholder="อีเมลล์"
                                            id="credit_email" name="credit_email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer  p-4">
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

        // เมื่อหน้าโหลดเสร็จ ให้แสดงภาพที่เก็บไว้ในฐานข้อมูล
        window.onload = function() {
            const savedImage = document.getElementById('imagePreview');
            if (savedImage.src === "") {
                savedImage.src = "{{ asset($job->job_image) }}"; // ใช้ค่า job_image ที่เก็บในฐานข้อมูล
            }
        };

        // ฟังก์ชันส่งฟอร์มแบบ AJAX
        $("#editJobForm").submit(function(e) {
            e.preventDefault();
            $("button[type='submit']").prop('disabled', true);

            // แสดงข้อความเพื่อให้ทราบว่าฟอร์มกำลังส่งข้อมูล
            console.log('กำลังส่งข้อมูล...');

            $.ajax({
                url: '{{ route('account.updateJob', $job->id) }}',
                type: 'POST',
                dataType: 'json',
                data: new FormData($("#editJobForm")[0]), // ส่งข้อมูลฟอร์มรวมถึงไฟล์
                contentType: false, // ไม่ต้องส่ง Content-Type
                processData: false, // ไม่ต้องแปลงข้อมูล
                success: function(response) {
                    // ตรวจสอบการตอบกลับ
                    console.log('Response:', response);

                    $("button[type='submit']").prop('disabled', false);
                    if (response.status == true) {
                        // ลบการแสดงข้อผิดพลาดจากแต่ละฟิลด์
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
                        $('#credit_name').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');

                        // เปลี่ยนเส้นทางไปหน้าของงานที่บันทึก
                        window.location.href = "{{ route('account.myJobs') }}";
                    } else {
                        // หากเกิดข้อผิดพลาดในเซิร์ฟเวอร์
                        var error = response.errors;

                        console.log('Errors:', error);

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

                        if (error.credit_name) {
                            $('#credit_name').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(error.credit_name);
                        } else {
                            $('#credit_name').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        // ตรวจสอบ error สำหรับ image ด้วย
                        if (error.image) {
                            $('#imageInput').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(error.image);
                        } else {
                            $('#imageInput').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // หากมีข้อผิดพลาดที่เกิดขึ้นในระหว่างการส่งคำขอ
                    console.error('AJAX Error:', error);
                    alert('เกิดข้อผิดพลาดระหว่างการส่งข้อมูล');
                }
            });
        });
    </script>
@endsection
