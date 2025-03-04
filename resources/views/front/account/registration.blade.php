@extends('front.layouts.app')

@section('main')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">ลงทะเบียนผู้ใช้</h1>
                        <form action="" name="registrationForm" id="registrationForm">
                            <div class="mb-3">
                                <label for="name" class="mb-2">ชื่อผู้ใช้*</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="ชื่อผู้ใช้">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="mb-2">อีเมลล์*</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="อีเมลล์">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="mb-2">รหัสผ่าน*</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="รหัสผ่าน">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="mb-2">ยืนยันรหัสผ่าน*</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="ยืนยันรหัสผ่าน">
                                <p></p>
                            </div>
                            <button class="btn btn-primary mt-2">ลงทะเบียน</button>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p>คุณมีบัญชีแล้ว? <a href="{{ route('account.login') }}">เข้าสู่ระบบ</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $('#registrationForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('account.processRegistration') }}',
                type: 'post',
                data: $("#registrationForm").serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == false) {
                        var errors = response.errors;

                        if (errors.name) {
                            $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                        } else {
                            $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                        }

                        if (errors.email) {
                            $('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email);
                        } else {
                            $('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                        }

                        if (errors.password) {
                            $('#password').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.password);
                        } else {
                            $('#password').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                        }

                        if (errors.password_confirmation) {
                            $('#password_confirmation').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.password_confirmation);
                        } else {
                            $('#password_confirmation').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                        }

                    } else {
                        // ล้าง Error และ Reset ฟอร์ม
                        $("#name").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html("");
                        $("#email").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html("");
                        $("#password").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html("");
                        $("#password_confirmation").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html("");
                        
                        window.location.href = "{{ route('account.login') }}";
                    }
                }
            });
        });
    </script>
@endsection
