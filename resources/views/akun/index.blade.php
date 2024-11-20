@extends('layouts.main_layout')

@section('container')
    <div class='container mt-5'>
        <div class='card'>
            <h5 class="card-header">Daftar Akun</h5>
            <hr class="my-0">
            <div class='card-body'>
                <button onclick="tambah()" class='btn btn-success' style='margin-bottom:20px;'>Tambah Akun</button>
                <div style='overflow:auto;'>
                    <table class='table table-striped datatable'>
                        <thead>
                            <tr>
                                <th style='width:20px;'>No</th>
                                <th style='text-align:center;'>Peran</th>
                                <th style='text-align:center;'>Username</th>
                                <th style='text-align:center;'>Nama</th>
                                <th style='text-align:center;'>Edit</th>
                                <th style='text-align:center;'>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akuns as $akun)
                                <tr>
                                    <td style="text-align: right;">{{ $loop->iteration }}</td>

                                    <td style='text-align:center;'>
                                        @if ($akun->hasRole('admin'))
                                            Admin
                                        @elseif($akun->hasRole('tenaga_kesehatan'))
                                            @if ($akun->tipe_tenaga_kesehatan == 1)
                                                Dokter
                                            @else
                                                Pengobat Tradisional
                                            @endif
                                        @else
                                            Pasien
                                        @endif
                                    </td>

                                    <td style='text-align:center;'>{{ $akun->username }}</td>

                                    <td style='text-align:center;'>{{ $akun->nama }}</td>

                                    <td style='text-align:center;'>
                                        <button id='btn_edit'
                                            style='border:0;background-color:rgba(0,0,0,0);visibility:visible;'
                                            onclick='edit({{ $akun->id }})'>
                                            <i class='fa fa-edit' style='color:#3c8dbc;'></i>
                                        </button>
                                    </td>

                                    <td style='text-align:center;'>
                                        <button id='btn_hapus'
                                            style='border:0;background-color:rgba(0,0,0,0);visibility:visible;'
                                            onclick='hapus({{ $akun->id }})'>
                                            <i class='fa fa-trash' style='color:#3c8dbc;'></i>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- modal tambah --}}
    <div class="modal" tabindex="-1" id='modal_tambah'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/akun" method='POST' id='form_tambah'>
                        @csrf

                        <div class="form-group">
                            <label>Tipe Akun *</label>
                            <select name="tipe_akun" class='form-control select2' style="width: 100%;">
                                <option value="">-- PILIH TIPE AKUN --</option>
                                <option value="1">Dokter</option>
                                <option value="2">Pengobat Tradisional</option>
                                <option value="0">Pasien</option>
                            </select>
                            <span class='help-block'>Tipe akun tidak bisa diedit</span>
                        </div>

                        <div class="form-group">
                            <label>Username *</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <input type="text" class="form-control" name="username" required=""
                                    onkeyup='$(this).val($(this).val().toLowerCase())'>
                            </div>
                            <span class='help-block'>Username tidak boleh mengandung spasi</span>
                        </div>

                        <div class="form-group">
                            <label>Nama *</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <input type="text" class="form-control" name="nama" required="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Password *</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <input type="password" class="form-control input_password_akun" id="password"
                                    name="password" required="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Password *</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <input type="password" class="form-control input_password_akun" id="konfirmasi_password"
                                    name="konfirmasi_password" required="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="checkbox-show-password-akun">
                                    <label class="form-check-label" for="checkbox-show-password-akun">
                                        Perlihatkan Password
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style='text-align:center;'>
                            <button type='submit' class="btn btn-success">Tambah</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal" tabindex="-1" id='modal_edit'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/akun/id_dari_js" method='POST' id='form_edit'>
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label>Tipe Akun *</label>
                            <select id='tipe_akun_edit' class='form-control' disabled>
                                <option value="">-- PILIH TIPE AKUN --</option>
                                <option value="1">Dokter</option>
                                <option value="2">Pengobat Tradisional</option>
                                <option value="0">Pasien</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>USERNAME *</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <input type="text" class="form-control" name="username" id='username_edit'
                                    required="" onkeyup='$(this).val($(this).val().toLowerCase())'>
                            </div>
                            <span class='help-block'>Username tidak boleh mengandung spasi</span>
                        </div>

                        <div class="form-group">
                            <label>NAMA *</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <input type="text" class="form-control" name="nama" id='nama_edit'
                                    required="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>PASSWORD *</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <input type="password" class="form-control input_password_akun" name="password" />
                            </div>
                            <span class='help-block'>Kosongkan bila tidak ingin mengubah password</span>
                        </div>

                        <div class="form-group">
                            <label>KONFIRMASI PASSWORD *</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <input type="password" class="form-control input_password_akun"
                                    name="konfirmasi_password" />
                            </div>
                            <span class='help-block'>Kosongkan bila tidak ingin mengubah password</span>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="checkbox-show-password-akun-edit">
                                    <label class="form-check-label" for="checkbox-show-password-akun-edit">
                                        Perlihatkan Password
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style='text-align:center;'>
                            <button type='submit' class="btn btn-primary">Edit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal hapus --}}
    <div class="modal" tabindex="-1" id='modal_hapus'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin hapus akun ini?
                </div>
                <div class="modal-footer">
                    <form action="/akun/id_dari_js" method='POST' id='form_hapus'>
                        @csrf
                        @method('DELETE')

                        <div class="form-group" style='text-align:center;'>
                            <button type='submit' class="btn btn-danger">Hapus</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#checkbox-show-password-akun').change(function() {
            if ($(this).is(':checked')) {
                $('.input_password_akun').attr('type', 'text');
            } else {
                $('.input_password_akun').attr('type', 'password');
            }
        });
        $('#checkbox-show-password-akun-edit').change(function() {
            if ($(this).is(':checked')) {
                $('.input_password_akun').attr('type', 'text');
            } else {
                $('.input_password_akun').attr('type', 'password');
            }
        });

        function tambah() {
            $('#modal_tambah').modal('show');
        }

        function edit(id) {
            $('#form_edit').attr('action', '/akun/' + id);

            $.ajax({
                    url: '/akun/get_data/' + id,
                })
                .done(function(data) {
                    const akun = JSON.parse(data);

                    $('#peran_edit').val(akun.peran).change();
                    $('#username_edit').val(akun.username);
                    $('#nama_edit').val(akun.nama);

                    $('#modal_edit').modal('show');
                });

        }

        function hapus(id) {
            $('#form_hapus').attr('action', 'akun/' + id);
            $('#modal_hapus').modal('show');
        }
    </script>
@endsection
