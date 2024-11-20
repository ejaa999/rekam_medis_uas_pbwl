@extends('layouts.main_layout')

@section('container')
    <div class="container mt-3">

        <div class="card mb-4">
            <h5 class="card-header">Daftar Faskes</h5>
            <hr class="my-0">
            <div class="card-body">

                <button onclick="tambah()" class='btn btn-success' style='margin-bottom:20px;'>Tambah</button>
                <div style='overflow:auto;'>
                    <table class='table table-striped datatable'>
                        <thead>
                            <tr>
                                <th style='width:20px;'>No</th>
                                <th style='text-align:center;'>Lokasi</th>
                                <th style='text-align:center;'>Nama Faskes</th>
                                <th style='text-align:center;'>Tipe</th>
                                <th style='text-align:center;'>Edit</th>
                                <th style='text-align:center;'>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($faskeses as $faskes)
                                <tr>


                                    <td style="text-align:right;">{{ $loop->iteration }}</td>

                                    <td style="text-align:center;">
                                        {{ $faskes->alamat }}
                                        <hr class='mt-1 mb-1'>
                                        {{ $faskes->kota }}, {{ $faskes->provinsi }}
                                    </td>

                                    <td style='text-align:center;'>
                                        {{ $faskes->nama }}
                                    </td>

                                    <td style='text-align:center;'>
                                        {{ $faskes->tipe_faskes == 1 ? 'Faskes Modern' : 'Faskes Tradisional' }}
                                    </td>

                                    <td style='text-align:center;'>
                                        <button id='btn_edit'
                                            style='border:0;background-color:rgba(0,0,0,0);visibility:visible;'
                                            onclick='edit(1)'>
                                            <i class='fa fa-edit' style='color:#3c8dbc;'></i>
                                        </button>
                                    </td>

                                    <td style='text-align:center;'>
                                        <button id='btn_hapus'
                                            style='border:0;background-color:rgba(0,0,0,0);visibility:visible;'
                                            onclick='hapus(1)'>
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
    <div class="modal" id='modal_tambah'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Faskes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/faskes" method='POST' id='form_tambah'>
                        @csrf

                        <div class='mb-3'>
                            <label class='form-label' for="nama">Nama</label>
                            <input type="text" class='form-control' name="nama" id="nama"
                                placeholder="Rumah Sakit Bersahaja" required>
                        </div>

                        <div class='mb-3'>
                            <label class='form-label' for="tipe_faskes">Tipe Faskes</label>
                            <select class='form-control' name="tipe_faskes" id="tipe_faskes" style="width: 100%;" required>
                                <option value="1">Faskes Modern</option>
                                <option value="2">Faskes Tradisional</option>
                            </select>
                        </div>

                        <div class='mb-3'>
                            <label class='form-label' for="alamat">Alamat</label>
                            <input type="text" class='form-control' name="alamat" id="alamat"
                                placeholder="Jl. Kesehatan No.1 (tanpa kota dan provinsi)" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="provinsi">Provinsi</label>
                            <input type="hidden" name="provinsi" id="provinsi_asli_tambah">
                            <div class="position-relative">
                                <select id="provinsi_tambah" class='form-control' aria-hidden="true" style='width:100%;'
                                    required onchange="get_kota($(this).val())">
                                    {{-- diisi dari js --}}
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="kota">Kota</label>
                            <input type="hidden" name="kota" id="kota_asli_tambah">
                            <div class="position-relative">
                                <select id="kota_tambah" class='form-control' aria-hidden="true" style='width:100%;'
                                    required onchange="save_kota($(this).val())">
                                    {{-- diisi dari js --}}
                                </select>
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
    <div class="modal" id='modal_edit'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Faskes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="diisi_dari_js" method='POST' id='form_edit'>
                        @csrf
                        @method('PUT')

                        <div class='mb-3'>
                            <label class='form-label' for="nama">Nama</label>
                            <input type="text" class='form-control' name="nama" id="nama_edit"
                                placeholder="Rumah Sakit Bersahaja" required>
                        </div>

                        <div class='mb-3'>
                            <label class='form-label' for="tipe_faskes">Tipe Faskes</label>
                            <select class='form-control' name="tipe_faskes" id="tipe_faskes_edit" style="width: 100%;"
                                required>
                                <option value="1">Faskes Modern</option>
                                <option value="2">Faskes Tradisional</option>
                            </select>
                        </div>

                        <div class='mb-3'>
                            <label class='form-label' for="alamat">Alamat</label>
                            <input type="text" class='form-control' name="alamat" id="alamat_edit"
                                placeholder="Jl. Kesehatan No.1 (tanpa kota dan provinsi)" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="provinsi">Provinsi</label>
                            <input type="hidden" name="provinsi" id="provinsi_asli_edit">
                            <div class="position-relative">
                                <select id="provinsi_edit" class='form-control' aria-hidden="true" style='width:100%;'
                                    required onchange="get_kota($(this).val())">
                                    {{-- diisi dari js --}}
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="kota">Kota</label>
                            <input type="hidden" name="kota" id="kota_asli_edit">
                            <div class="position-relative">
                                <select id="kota_edit" class='form-control' aria-hidden="true" style='width:100%;'
                                    required onchange="save_kota($(this).val())">
                                    {{-- diisi dari js --}}
                                </select>
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
    <div class="modal" id='modal_hapus'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Faskes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin hapus faskes ini?
                </div>
                <div class="modal-footer">
                    <form action="diisi_dari_js" method='POST' id='form_hapus'>
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


    {{-- fungsi2 aksi --}}
    <script>
        function tambah() {
            $('#modal_tambah').modal('show');
        }

        function edit(id) {
            $.ajax({
                    url: "/faskes/get_data/" + id,
                })
                .done(function(data) {
                    const faskes = JSON.parse(data);
                    $('#form_edit').attr('action', '/faskes/' + id);
                    $('#nama_edit').val(faskes.nama);
                    $('#tipe_faskes_edit').val(faskes.tipe_faskes);
                    $('#alamat_edit').val(faskes.alamat);

                    $('#modal_edit').modal('show');
                });

        }

        function hapus(id) {
            $('#form_hapus').attr('action', 'faskes/' + id);
            $('#modal_hapus').modal('show');
        }
    </script>


    {{-- utk prov dan kota --}}
    <script>
        $(document).ready(function() {

            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                .then(response => response.json())
                .then(provinces => {
                    let options = "<option value=''>-- PILIH PROVINSI --</option>";
                    provinces.forEach(function(item) {
                        options += "<option value='" + item.id + "'>" + item.name + "</option>";
                    });

                    $('#provinsi_tambah').html(options);
                    $('#provinsi_edit').html(options);
                });

        });


        function get_kota(provinsi_id) {
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/province/' + provinsi_id + '.json')
                .then(response => response.json())
                .then(province => {
                    $('#provinsi_asli_tambah').val(province.name);
                    $('#provinsi_asli_edit').val(province.name);
                });

            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + provinsi_id + '.json')
                .then(response => response.json())
                .then(regencies => {
                    let options = "<option value=''>-- PILIH KOTA --</option>";
                    regencies.forEach(function(item) {
                        options += "<option value='" + item.id + "'>" + item.name + "</option>";
                    });

                    $('#kota_tambah').html(options);
                    $('#kota_edit').html(options);
                });

        };

        function save_kota(kota_id) {
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/regency/' + kota_id + '.json')
                .then(response => response.json())
                .then(regency => {
                    $('#kota_asli_tambah').val(regency.name);
                    $('#kota_asli_edit').val(regency.name);
                });
        };
    </script>
@endsection
