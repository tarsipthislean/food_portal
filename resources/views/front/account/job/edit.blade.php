@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
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
                                <h3 class="fs-4 mb-1">Job Edit Details</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Title<span class="req">*</span></label>
                                        <input value="{{ $job->title }}" type="text" placeholder="Job Title"
                                            id="title" name="title" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select a Category</option>
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
                                        <label for="" class="mb-2">Job Type<span class="req">*</span></label>
                                        <select name="jobType" id="jobType" class="form-select">
                                            <option value="">Select Job Type</option>
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
                                        <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input value="{{ $job->vacancy }}" type="number" min="1"
                                            placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location<span class="req">*</span></label>
                                        <input value="{{ $job->location }}" type="text" placeholder="location"
                                            id="location" name="location" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="form-control" name="description" id="description" cols="5" rows="5"
                                        placeholder="Description">{{ $job->description }}</textarea>
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Benefits</label>
                                    <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ $job->benefits }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Responsibility</label>
                                    <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5"
                                        placeholder="Responsibility">{{ $job->responsibility }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Qualifications</label>
                                    <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5"
                                        placeholder="Qualifications">{{ $job->qualifications }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Experience <span class="req">*</span>
                                    </label>
                                    <select name="experience" id="experience" class="form-control">
                                        <option value="1" {{ $job->experience == '1' ? 'selected' : '' }}>1 Year
                                        </option>
                                        <option value="2" {{ $job->experience == '2' ? 'selected' : '' }}>2 Year
                                        </option>
                                        <option value="3" {{ $job->experience == '3' ? 'selected' : '' }}>3 Year
                                        </option>
                                        <option value="4" {{ $job->experience == '4' ? 'selected' : '' }}>4 Year
                                        </option>
                                        <option value="5" {{ $job->experience == '5' ? 'selected' : '' }}>5 Year
                                        </option>
                                        <option value="6" {{ $job->experience == '6' ? 'selected' : '' }}>6 Year
                                        </option>
                                        <option value="7" {{ $job->experience == '7' ? 'selected' : '' }}>7 Year
                                        </option>
                                        <option value="8" {{ $job->experience == '8' ? 'selected' : '' }}>8 Year
                                        </option>
                                        <option value="9" {{ $job->experience == '9' ? 'selected' : '' }}>9 Year
                                        </option>
                                        <option value="10" {{ $job->experience == '10' ? 'selected' : '' }}>10 Year
                                        </option>
                                        <option value="10_plus" {{ $job->experience == '10_plus' ? 'selected' : '' }}>10+
                                            Year</option>
                                    </select>
                                    <p></p>
                                </div>


                                <div class="mb-4">
                                    <label for="" class="mb-2">Keywords</label>
                                    <input value="{{ $job->keywords }}" type="text" placeholder="keywords"
                                        id="keywords" name="keywords" class="form-control">
                                </div>
                                <!-- ส่วนการอัพโหลดและแสดงตัวอย่างภาพ -->
                                <div class="mb-4">
                                    <label for="" class="mb-2">Image</label>
                                    <input type="file" name="image" class="form-control" id="imageInput"
                                        onchange="previewImage(event)">

                                    <!-- แสดงตัวอย่างภาพที่เลือก -->
                                    <img id="imagePreview" src="{{ asset($job->job_image) }}" alt="Current Image"
                                        style="max-width: 300px; max-height: 300px; object-fit: cover; margin-top: 10px;">
                                </div>


                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Credit Details</h3>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Name<span class="req">*</span></label>
                                        <input value="{{ $job->company_name }}" type="text"
                                            placeholder="Company Name" id="company_name" name="company_name"
                                            class="form-control">
                                        <p></p>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location</label>
                                        <input value="{{ $job->company_location }}" type="text"
                                            placeholder="company_location" id="company_location" name="company_location"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Save Job</button>
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
                        $('#company_name').removeClass('is-invalid').siblings('p').removeClass(
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

                        if (error.company_name) {
                            $('#company_name').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(error.company_name);
                        } else {
                            $('#company_name').removeClass('is-invalid').siblings('p').removeClass(
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
