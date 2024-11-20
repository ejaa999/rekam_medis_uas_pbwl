@php
    $asuransi_pasiens = auth()->user()->asuransi_pasien_list;
@endphp

<div class="card mb-4">
    <h5 class="card-header">Asuransi Pasien</h5>
    <hr class="my-0">
    <div class="card-body">

        {{-- <h4 style='text-align:center;'>Daftar Akun</h4> --}}
        <button onclick="tambah_asuransi()" class='btn btn-success' style='margin-bottom:20px;'>Tambah</button>
        <div style='overflow:auto;'>
            <table class='table table-striped datatable'>
                <thead>
                    <tr>
                        <th style='width:20px;'>No</th>
                        <th style='text-align:center;'>Penyedia Asuransi</th>
                        <th style='text-align:center;'>Nomor Polis</th>
                        <th style='text-align:center;'>No Telepon</th>
                        <th style='text-align:center;'>Email</th>
                        <th style='text-align:center;'>Edit</th>
                        <th style='text-align:center;'>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asuransi_pasiens as $asuransi_pasien)
                        <tr>
                            <td style='text-align:right'>{{ $loop->iteration }}</td>

                            <td style="text-align: center;">
                                {{ $asuransi_pasien->penyedia }}
                            </td>

                            <td style="text-align: center;">
                                {{ $asuransi_pasien->nomor_polis }}
                            </td>

                            <td style="text-align: center;">
                                {{ $asuransi_pasien->no_telepon }}
                            </td>

                            <td style="text-align: center;">
                                {{ $asuransi_pasien->email }}
                            </td>

                            <td style="text-align: center;">
                                <button id='btn_edit'
                                    style='border:0;background-color:rgba(0,0,0,0);visibility:visible;'
                                    onclick='edit_asuransi({{ $asuransi_pasien->id }})'>
                                    <i class='fa fa-pencil' style='color:#3c8dbc;'></i>
                                </button>
                            </td>

                            <td style="text-align: center;">
                                <button id='btn_hapus'
                                    style='border:0;background-color:rgba(0,0,0,0);visibility:visible;'
                                    onclick='hapus_asuransi({{ $asuransi_pasien->id }})'>
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


{{-- modal tambah --}}
<div class="modal" id='modal_tambah_asuransi'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Asuransi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/asuransi_pasien" method='POST' id='form_tambah'>
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Penyedia Asuransi*</label>
                        <div class="position-relative">
                            <input type="text" required class="form-control" name="penyedia"
                                placeholder="Contoh : Prudential, BPJS">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Polis*</label>
                        <div class="position-relative">
                            <input type="text" required class="form-control" name="nomor_polis">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No Telepon Penyedia Asuransi*</label>
                        <div class="position-relative">
                            <input type="text" required class="form-control" name="no_telepon">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Penyedia Asuransi*</label>
                        <div class="position-relative">
                            <input type="email" required class="form-control" name="email">
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
<div class="modal" id='modal_edit_asuransi'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Faskes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="diisi_dari_js" method='POST' id='form_edit_asuransi'>
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Penyedia Asuransi*</label>
                        <div class="position-relative">
                            <input type="text" required class="form-control" name="penyedia" id="penyedia_edit"
                                placeholder="Contoh : Prudential, BPJS">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Polis*</label>
                        <div class="position-relative">
                            <input type="text" required class="form-control" name="nomor_polis"
                                id="nomor_polis_edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No Telepon Penyedia Asuransi*</label>
                        <div class="position-relative">
                            <input type="text" required class="form-control" name="no_telepon"
                                id="no_telepon_edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Penyedia Asuransi*</label>
                        <div class="position-relative">
                            <input type="email" required class="form-control" name="email" id="email_edit">
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
<div class="modal" id='modal_hapus_asuransi'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Asuransi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin hapus asuransi ini?
            </div>
            <div class="modal-footer">
                <form action="diisi_dari_js" method='POST' id='form_hapus_asuransi'>
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
    function tambah_asuransi() {
        $('#modal_tambah_asuransi').modal('show');
    }

    function hapus_asuransi(id) {
        $('#form_hapus_asuransi').attr('action', 'asuransi_pasien/' + id);
        $('#modal_hapus_asuransi').modal('show');
    }

    function edit_asuransi(id) {
        $.ajax({
                url: "/asuransi_pasien/get_data/" + id
            })
            .done(function(data) {
                const asuransi_pasien = JSON.parse(data);

                $('#penyedia_edit').val(asuransi_pasien.penyedia);
                $('#nomor_polis_edit').val(asuransi_pasien.nomor_polis);
                $('#no_telepon_edit').val(asuransi_pasien.no_telepon);
                $('#email_edit').val(asuransi_pasien.email);

                $('#form_edit_asuransi').attr('action', "/asuransi_pasien/" + id);
                $('#modal_edit_asuransi').modal('show');
            });
    }
</script>
