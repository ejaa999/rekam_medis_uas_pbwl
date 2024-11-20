@extends('layouts.main_layout')

@section('container')
    <div class="container mt-3">
        <div class="card mb-4">
            <h5 class="card-header">Permintaan Menghubungkan</h5>
            <hr class="my-0">
            <div class="card-body">

                <div style='overflow:auto;'>
                    <table class='table table-striped datatable'>
                        <thead>
                            <tr>
                                <th style='width:20px;'>No</th>
                                <th style='text-align:center;'>Foto</th>
                                <th style='text-align:center;'>Nama</th>
                                <th style='text-align:center;'>Terima</th>
                                <th style='text-align:center;'>Tolak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hubungan_calon_pasiens as $hubungan_calon_pasien)
                                <tr>
                                    <td style='text-align:right'>{{ $loop->iteration }}</td>

                                    <td>
                                        <div style='display:flex;'>
                                            <div style='margin:0 auto;'>
                                                <img src="{{ $hubungan_calon_pasien->pasien->foto_profil == 'assets/img/avatars/user.png' ? asset($hubungan_calon_pasien->pasien->foto_profil) : asset('storage/' . $hubungan_calon_pasien->pasien->foto_profil) }}"
                                                    alt="user-avatar" class="d-block rounded" height="100" width="100">
                                            </div>
                                        </div>
                                    </td>

                                    <td style="text-align: center;">
                                        {{ $hubungan_calon_pasien->pasien->nama }}
                                    </td>

                                    <td style="text-align: center;">
                                        <button id='btn_terima'
                                            style='border:0;background-color:rgba(0,0,0,0);visibility:visible;'
                                            onclick='terima({{ $hubungan_calon_pasien->id }})'>
                                            <i class='fa fa-check' style='color:#3c8dbc;'></i>
                                        </button>
                                    </td>

                                    <td style="text-align: center;">
                                        <button id='btn_tolak'
                                            style='border:0;background-color:rgba(0,0,0,0);visibility:visible;'
                                            onclick='tolak({{ $hubungan_calon_pasien->id }})'>
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

    {{-- modal terima --}}
    <div class="modal" id='modal_terima'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menerima?

                </div>

                <div class="modal-footer">
                    <form action="diisi_dari_js" method='POST' id='form_terima'>
                        @csrf

                        <div class="form-group" style='text-align:center;'>
                            <button type='submit' class="btn btn-success">Terima</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal tolak --}}
    <div class="modal" id='modal_tolak'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menolak?

                </div>

                <div class="modal-footer">
                    <form action="diisi_dari_js" method='POST' id='form_tolak'>
                        @csrf

                        <div class="form-group" style='text-align:center;'>
                            <button type='submit' class="btn btn-danger">Tolak</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function terima(id) {
            $('#form_terima').attr('action', '/hubungan/terima/' + id);
            $('#modal_terima').modal('show');
        }

        function tolak(id) {
            $('#form_tolak').attr('action', '/hubungan/tolak/' + id);
            $('#modal_tolak').modal('show');
        }
    </script>
@endsection
