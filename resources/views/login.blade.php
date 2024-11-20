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
                        <h4 class="mb-2 text-center">Login</h4>
                        <p class="mb-4" style='text-align:center;'>Rekam Medisku</p>

                        <form id="formAuthentication" class="mb-3" action="/login" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Masukkan Username" autofocus="">
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="············" aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                            </div>
                            <div class="mb-3">
                                belum punya akun?
                                <br>
                                <a href="/register">Register</a>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    @if (session()->has('loginError'))
        <script>
            iziToast.error({
                title: "{{ session('loginError') }}",
                position: 'topCenter'
            });
        </script>
    @endif
@endsection
