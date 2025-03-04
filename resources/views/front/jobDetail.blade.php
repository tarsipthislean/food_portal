@extends('front.layouts.app')

@section('main')
    <section class="section-4 bg-2">
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('jobs') }}">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;กลับหน้าค้นหาสูตรอาหาร
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container job_details_area">
            <!-- Container สำหรับแสดงข้อความแจ้งเตือน (Flash Message) -->
            <div id="flash-message">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            </div>

            <div class="row pb-5">
                <div class="col-md-8">
                    <div class="card shadow border-0">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    <div class="jobs_conetent">
                                        <a href="#">
                                            <h4 class="text-primary">{{ $job->title }}</h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p>
                                                    <i class="fa fa-map-marker"></i>
                                                    {{ $job->location }}
                                                </p>
                                            </div>
                                            <div class="location">
                                                <p>
                                                    <i class="fa fa-clock-o"></i>
                                                    {{ $job->jobType->name }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        <a class="heart_mark" href="#">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="descript_wrap white-bg p-4">
                            <h4 class="mb-3">แนะนำสูตรอาหาร</h4>
                            <div class="single_wrap">
                                {!! nl2br($job->description) !!}
                            </div>

                            @if (!empty($job->benefits))
                                <div class="single_wrap mt-4">
                                    <h4>สูตรอาหาร</h4>
                                    {!! nl2br($job->benefits) !!}
                                </div>
                            @endif

                            <div class="border-bottom"></div>
                            <div class="pt-3 text-end">
                                @if (Auth::check())
                                    <a href="#" onclick="applyJob({{ $job->id }})" class="btn btn-primary">บันทึกสูตรอาหาร</a>
                                @else
                                    <a href="javascript:void(0);" class="btn btn-primary disabled">เข้าสู่ระบบเพื่อใช้งาน</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>ข้อมูลสูตรอาหาร</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>เผยแพร่เมื่อ:
                                        <span>{{ \Carbon\Carbon::parse($job->created_at)->format('d, M Y') }}</span>
                                    </li>
                                    <li>จำนวนสูตรอาหาร: <span>{{ $job->vacancy }}</span></li>
                                    <li>ต้นตำรับสูตรอาหาร: <span>{{ $job->location }}</span></li>
                                    <li>ประเภทสูตรอาหาร: <span>{{ $job->jobType->name }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow border-0 my-4">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>โพสต์โดย</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>ชื่อผู้สร้าง: <span>{{ $job->credit_name }}</span></li>
                                    @if (!empty($job->credit_email))
                                        <li>อีเมลล์ติดต่อ: <span>{{ $job->credit_email }}</span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('customJs')
<script type="text/javascript">
// ตั้งค่า CSRF Token สำหรับ AJAX requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

function applyJob(id) {
    if (confirm('คุณแน่ใจหรือไม่ว่าต้องการบันทึกสูตรอาหารนี้?')) {
        $.ajax({
            url: '{{ route('applyJob') }}',
            type: 'POST',
            dataType: 'json',
            data: { id: id },
            success: function(response) {
                if (response.status === true) {
                    // เมื่อสมัครงานสำเร็จ ให้รีโหลดหน้าเพื่อแสดง flash message จาก session
                    window.location.href = "{{ url()->current() }}";
                } else {
                    // หากเกิด error ให้แสดงข้อความ error ใน container #flash-message
                    $('#flash-message').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function(xhr, status, error) {
                // กรณี AJAX request ล้มเหลว
                $('#flash-message').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
            }
        });
    }
}
</script>
@endsection