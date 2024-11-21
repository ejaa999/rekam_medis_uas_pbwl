@extends('layouts.main_layout')

@section('container')
    <div class="container mt-3">
        <div class="card mb-4">
            <h5 class="card-header">Pengajuan Menghubungkan</h5>
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
                                <th style='text-align:center;'>Ajukan Penghubungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($calon_tenaga_kesehatans as $calon_tenaga_kesehatan)
                                <tr>
                                    <td style='text-align:right'>{{ $i }}</td>

                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ $calon_tenaga_kesehatan->foto_profil && $calon_tenaga_kesehatan->foto_profil != 'assets/img/avatars/user.png'
                                                        ? asset('storage/' . $calon_tenaga_kesehatan->foto_profil)
                                                        : asset('assets/img/avatars/user.png') }}"
                                                alt="Foto {{ $calon_tenaga_kesehatan->nama ?? 'Calon Tenaga Kesehatan' }}"
                                                class="d-block rounded img-fluid"
                                                height="100" width="100"
                                                onerror="this.src='{{ asset('assets/img/avatars/user.png') }}';">
                                        </div>
                                    </td>


                                    <td style="text-align: center;">
                                        {{ $calon_tenaga_kesehatan->nama }}
                                        <hr>
                                        {{ $calon_tenaga_kesehatan->no_hp }}
                                    </td>

                                    <td style='text-align:center;'>
                                        @if (count($calon_tenaga_kesehatan->surat_ijin_praktek_list) > 0)
                                            @foreach ($calon_tenaga_kesehatan->surat_ijin_praktek_list as $surat_ijin_praktek)
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
                                            onclick='show_faskes({{ $calon_tenaga_kesehatan->id }})'>
                                            <i class='fa fa-file' style='color:#3c8dbc;'></i>
                                        </button>
                                    </td>

                                    <td style="text-align: center;">
                                        <button id='btn_ajukan'
                                            style='border:0;background-color:rgba(0,0,0,0);visibility:visible;'
                                            onclick='ajukan({{ $calon_tenaga_kesehatan->id }})'>
                                            <i class='fa fa-check' style='color:#3c8dbc;'></i>
                                        </button>
                                    </td>

                                </tr>

                                @php
                                    $i++;
                                @endphp
                            @endforeach

                            @foreach ($calon_tenaga_kesehatans_tunggu_respon as $calon_tenaga_kesehatan)
                                <tr>
                                    <td style='text-align:right'>{{ $i }}</td>

                                    <td>
                                        <div style='display:flex;'>
                                            <div style='margin:0 auto;'>
                                                <img src="{{ $calon_tenaga_kesehatan->foto_profil == 'assets/img/avatars/user.png' ? asset($calon_tenaga_kesehatan->foto_profil) : asset('storage/' . $calon_tenaga_kesehatan->foto_profil) }}"
                                                    alt="user-avatar" class="d-block rounded" height="100" width="100">
                                            </div>
                                        </div>
                                    </td>


                                    <td style="text-align: center;">
                                        {{ $calon_tenaga_kesehatan->nama }}
                                        <hr>
                                        {{ $calon_tenaga_kesehatan->no_hp }}
                                    </td>

                                    <td style='text-align:center;'>
                                        @if (count($calon_tenaga_kesehatan->surat_ijin_praktek_list) > 0)
                                            @foreach ($calon_tenaga_kesehatan->surat_ijin_praktek_list as $surat_ijin_praktek)
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
                                            onclick='show_faskes({{ $calon_tenaga_kesehatan->id }})'>
                                            <i class='fa fa-file' style='color:#3c8dbc;'></i>
                                        </button>
                                    </td>      

                                    <td style="text-align: center;">
                                        Tunggu Respon
                                    </td>

                                </tr>


                                @php
                                    $i++;
                                @endphp
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

    {{-- modal ajukan --}}
    <div class="modal" id='modal_ajukan'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin mengajukan?

                </div>

                <div class="modal-footer">
                    <form action="diisi_dari_js" method='POST' id='form_ajukan'>
                        @csrf

                        <div class="form-group" style='text-align:center;'>
                            <button type='submit' class="btn btn-success">Ajukan</button>
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

        function ajukan(id) {
            $('#form_ajukan').attr('action', '/hubungan/submit_ajukan/' + id);
            $('#modal_ajukan').modal('show');
        }
    </script>
@endsection
