@extends('layouts.main_layout')

@section('container')
    <div class="container-xxl d-flex justify-content-center">
        <div class="authentication-wrapper authentication-basic container-p-y d-flex mt-5 pt-5">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2 text-center">Register</h4>
                        <p class="mb-4" style='text-align:center;'>Rekam Medisku</p>
                        <div class="alert alert-danger" role="alert" id='alert_js' style='display:none;'>
                            {{-- isi dari js --}}
                        </div>

                        <form id="formAuthentication" class="mb-3" action="/register" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Masukkan Username" autofocus="" required>
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukkan Nama" required>
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="············" aria-describedby="password" required>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="konfirmasi_password">Konfirmasi Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="konfirmasi_password" class="form-control"
                                        placeholder="············" aria-describedby="password" required>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit"
                                    id="btn_register">Register</button>
                            </div>

                        </form>

                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <script>
        $('#username').keyup(function() {
            var usernameRegex = /^\S*$/;
            if (usernameRegex.test($('#username').val())) {
                $('#alert_js').html('Username tanpa spasi');
                $('#alert_js').css('display', 'none');
                $('#btn_register').prop('disabled', false);
                is_valid = true;
            } else {
                $('#alert_js').html('Username tanpa spasi');
                $('#alert_js').css('display', 'block');
                $('#btn_register').prop('disabled', true);
            }
        });

        $('#konfirmasi_password').keyup(function() {
            if ($('#password').val() == $('#konfirmasi_password').val()) {
                $('#alert_js').html('konfirmasi password salah');
                $('#alert_js').css('display', 'none');
                $('#btn_register').prop('disabled', false);
            } else {
                $('#alert_js').html('konfirmasi password salah');
                $('#alert_js').css('display', 'block');
                $('#btn_register').prop('disabled', true);
            }
        });
    </script>
@endsection
