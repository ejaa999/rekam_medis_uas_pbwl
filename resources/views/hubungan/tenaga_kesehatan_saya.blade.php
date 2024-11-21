@extends('layouts.main_layout')

@section('container')
    <div class="container mt-3">
        <div class="card mb-4">
            <h5 class="card-header">Tenaga Kesehatan Saya</h5>
            <hr class="my-0">
            <div class="card-body">

                <div style='overflow:auto;'>
                    <table class='table table-striped datatable'>
                        <thead>
                            <tr>
                                <th style='width:20px;'>No</th>
                                <th style='text-align:center;'>Foto</th>
                                <th style='text-align:center;'>Nama</th>
                                <th style='text-align:center;'>Surat Ijin Praktek</th>
                                <th style='text-align:center;'>Fasilitas Kesehatan</th>
                                <th style='text-align:center;'>Putuskan Hubungan</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($tenaga_kesehatans_saya as $tenaga_kesehatan_saya)
                                <tr>
                                    <td style='text-align:right'>{{ $loop->iteration }}</td>

                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ $tenaga_kesehatan_saya->foto_profil && $tenaga_kesehatan_saya->foto_profil != 'assets/img/avatars/user.png'
                                                        ? asset('storage/' . $tenaga_kesehatan_saya->foto_profil)
                                                        : asset('assets/img/avatars/user.png') }}"
                                                alt="Foto {{ $tenaga_kesehatan_saya->nama ?? 'Tenaga Kesehatan' }}"
                                                class="d-block rounded img-fluid"
                                                height="100" width="100"
                                                onerror="this.src='{{ asset('assets/img/avatars/user.png') }}';">
                                        </div>
                                    </td>


                                    <td style="text-align: center;">
                                        {{ $tenaga_kesehatan_saya->nama }}
                                        <hr>
                                        {{ $tenaga_kesehatan_saya->no_hp }}
                                    </td>

                                    <td style='text-align:center;'>
                                        @if (count($tenaga_kesehatan_saya->surat_ijin_praktek_list) > 0)
                                            @foreach ($tenaga_kesehatan_saya->surat_ijin_praktek_list as $surat_ijin_praktek)
                                                <a href="/storage/{{ $surat_ijin_praktek->file_path }}"
                                                    target="_blank">{{ $surat_ijin_praktek->original_name }}</a>
                                                <hr>
                                            @endforeach
                                        @else
                                            Belum ada surat ditambahkan
                                        @endif
                                    </td>

                                    <td style="text-align: center;">
                                        <button id='btn_show_faskes'
                                            style='border:0;background-color:rgba(0,0,0,0);visibility:visible;'
                                            onclick='show_faskes({{ $tenaga_kesehatan_saya->id }})'>
                                            <i class='fa fa-file' style='color:#3c8dbc;'></i>
                                        </button>
                                    </td>

                                    <td style="text-align: center;">
                                        <button id='btn_putuskan_hubungan'
                                            style='border:0;background-color:rgba(0,0,0,0);visibility:visible;'
                                            onclick='putuskan_hubungan({{ $tenaga_kesehatan_saya->id }})'>
                                            <i class='fa fa-times' style='color:#3c8dbc;'></i>
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


    {{-- modal show_faskes --}}
    <div class="modal" id='modal_show_faskes'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Faskes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="diisi dari js" alt="user-avatar" class="d-block rounded" height="100" width="100"
                            id='foto_profil_show_faskes'>
                        <div class="button-wrapper">
                            <h5 id='nama_show_faskes'>diisi dari js</h5>
                            <p class="text-muted mb-0" id='username_show_faskes'>diisi dari js</p>
                        </div>
                    </div>
                    <table class='table table-striped mt-3'>
                        <thead>
                            <tr>
                                <th>Nama Faskes</th>
                                <th>Alamat</th>
                                <th>Spesialisasi</th>
                            </tr>
                        </thead>
                        <tbody id='tbody_faskes'>
                            {{-- diisi dari js --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- modal putuskan hubungan --}}
    <div class="modal" id='modal_putuskan_hubungan'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin memutuskan hubungan?

                </div>

                <div class="modal-footer">
                    <form action="diisi_dari_js" method='POST' id='form_putuskan_hubungan'>
                        @csrf

                        <div class="form-group" style='text-align:center;'>
                            <button type='submit' class="btn btn-danger">Putuskan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function show_faskes(id) {
            $.ajax({
                    url: "/hubungan/get_faskes_has_tenaga_kesehatan/" + id
                })
                .done(function(data) {
                    const faskes_has_tenaga_kesehatans = JSON.parse(data);

                    let tbody = "";
                    faskes_has_tenaga_kesehatans.forEach(function(faskes_has_tenaga_kesehatan) {
                        tbody +=
                            "<tr>" +
                            "<td>" + faskes_has_tenaga_kesehatan.faskes.nama + "</td>" +
                            "<td>" +
                            faskes_has_tenaga_kesehatan.faskes.alamat +
                            "<hr>" +
                            faskes_has_tenaga_kesehatan.faskes.kota + ", " + faskes_has_tenaga_kesehatan.faskes
                            .provinsi +
                            "</td>" +
                            "<td>" + faskes_has_tenaga_kesehatan.spesialisasi + "</td>" +
                            "</tr>";

                    });

                    $('#tbody_faskes').html(tbody);

                });

            $.ajax({
                    url: "/hubungan/get_tenaga_kesehatan/" + id
                })
                .done(function(data) {
                    const tenaga_kesehatan = JSON.parse(data);


                    $('#nama_show_faskes').html(tenaga_kesehatan.nama);
                    $('#username_show_faskes').html(tenaga_kesehatan.username);

                    // foto profil
                    if (tenaga_kesehatan.foto_profil == "assets/img/avatars/user.png") {
                        $('#foto_profil_show_faskes').attr("src", "/assets/img/avatars/user.png");
                    } else {
                        $('#foto_profil_show_faskes').attr("src", "/storage/" + tenaga_kesehatan.foto_profil);
                    }

                    $('#modal_show_faskes').modal('show');

                });


        }

        function putuskan_hubungan(id) {
            $('#form_putuskan_hubungan').attr('action', '/hubungan/putuskan_hubungan/dari_pasien/' + id);
            $('#modal_putuskan_hubungan').modal('show');
        }
    </script>
@endsection
