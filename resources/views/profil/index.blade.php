@extends('layouts.main_layout')

@section('container')
    <div class="container mt-3">

        <div class="card mb-4">
            <h5 class="card-header">Profil</h5>
            <!-- Account -->

            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{{ auth()->user()->foto_profil == 'assets/img/avatars/user.png' ? asset(auth()->user()->foto_profil) : asset('storage/' . auth()->user()->foto_profil) }}"
                        alt="user-avatar" class="d-block rounded" height="100" width="100">
                    <div class="button-wrapper">
                        <form action="/profil/update_foto_profil" id="form_upload_foto_profil" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload Foto</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id='upload' name="foto_profil" class="account-file-input"
                                    hidden="" accept="image/png, image/jpeg"
                                    onchange="$('#form_upload_foto_profil').submit();">
                            </label>
                            <a href="/profil/reset_foto_profil" class="btn btn-label-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </a>
                        </form>

                        <p class="text-muted mb-0">Tipe gambar JPG, GIF or PNG.</p>
                    </div>
                </div>
            </div>

            <form action="/profil/update_profil" method="post" enctype="multipart/form-data">
                @csrf

                <hr class="my-0">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6 fv-plugins-icon-container">
                            <label class="form-label">Username</label>
                            <input class="form-control" type="text" name="username"
                                value='{{ auth()->user()->username }}' autofocus="" required>
                            <span class='help-block'>Username tidak boleh mengandung spasi</span>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        <div class="mb-3 col-md-6 fv-plugins-icon-container">
                            <label class="form-label">Nama</label>
                            <input class="form-control" type="text" name="nama" value='{{ auth()->user()->nama }}'
                                autofocus="" required>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        @if (auth()->user()->hasRole('pasien'))
                            <div class="mb-3 col-md-6 fv-plugins-icon-container">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="1" {{ auth()->user()->jenis_kelamin == 1 ? 'selected' : '' }}>Laki
                                        Laki</option>
                                    <option value="2" {{ auth()->user()->jenis_kelamin == 2 ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>

                            <div class="mb-3 col-md-6 fv-plugins-icon-container">
                                <label class="form-label">Tanggal Lahir</label>
                                <input class="form-control" type="date" name="tanggal_lahir"
                                    value='{{ auth()->user()->tanggal_lahir }}' autofocus="" required>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        @endif

                        <div class="mb-3 col-md-6 fv-plugins-icon-container">
                            <label class="form-label">No HP</label>
                            <input class="form-control" type="number" name="no_hp" value='{{ auth()->user()->no_hp }}'
                                autofocus="" required>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    </div>
                </div>

            </form>
            <!-- /Account -->


        </div>

        {{-- if dokter --}}
        @if (auth()->user()->hasRole('tenaga_kesehatan'))
            @include('profil.surat_ijin_praktek')
            @include('profil.faskes_profil')
        @endif

        {{-- if pasien --}}
        @if (auth()->user()->hasRole('pasien'))
            @include('profil.ktp_pasien')
            @include('profil.asuransi_pasien')
        @endif
    </div>
@endsection
