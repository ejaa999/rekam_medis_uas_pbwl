<div class="card mb-4">
    <h5 class="card-header">Fasilitas Kesehatan</h5>
    <hr class="my-0">
    <div class="card-body">

        {{-- <h4 style='text-align:center;'>Daftar Akun</h4> --}}
        <button onclick="tambah()" class='btn btn-success' style='margin-bottom:20px;'>Tambah</button>
        <div style='overflow:auto;'>
            <table class='table table-striped datatable'>
                <thead>
                    <tr>
                        <th style='width:20px;'>No</th>
                        <th style='text-align:center;'>Lokasi</th>
                        <th style='text-align:center;'>Nama Faskes</th>
                        <th style='text-align:center;'>Spesialisasi</th>
                        <th style='text-align:center;'>Edit</th>
                        <th style='text-align:center;'>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faskes_has_tenaga_kesehatans as $faskes_has_tenaga_kesehatan)
                        <tr>
                            <td style='text-align:right'>{{ $loop->iteration }}</td>

                            <td style='text-align:center'>
                                {{ $faskes_has_tenaga_kesehatan->faskes->alamat }}
                                <br>
                                {{ $faskes_has_tenaga_kesehatan->faskes->kota }},
                                {{ $faskes_has_tenaga_kesehatan->faskes->provinsi }}
                            </td>

                            <td style="text-align: center;">
                                {{ $faskes_has_tenaga_kesehatan->faskes->nama }}
                            </td>

                            <td style="text-align: center;">
                                {{ $faskes_has_tenaga_kesehatan->spesialisasi }}
                            </td>

                            <td style="text-align: center;">
                                <button id='btn_edit'
                                    style='border:0;background-color:rgba(0,0,0,0);visibility:visible;'
                                    onclick='edit({{ $faskes_has_tenaga_kesehatan->id }})'>
                                    <i class='fa fa-pencil' style='color:#3c8dbc;'></i>
                                </button>
                            </td>

                            <td style="text-align: center;">
                                <button id='btn_hapus'
                                    style='border:0;background-color:rgba(0,0,0,0);visibility:visible;'
                                    onclick='hapus({{ $faskes_has_tenaga_kesehatan->id }})'>
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
<div class="modal" id='modal_tambah'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Faskes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/faskes_has_tenaga_kesehatan" method='POST' id='form_tambah'>
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Faskes</label>
                        <div class="position-relative">
                            <select name="faskes_id" class='form-control' aria-hidden="true" style='width:100%;'>
                                <option value="">-- PILIH FASKES --</option>
                                @foreach ($faskeses as $faskes)
                                    <option value="{{ $faskes->id }}">{{ $faskes->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Spesialisasi</label>
                        <div class="position-relative">
                            <input type="text" class="form-control" name="spesialisasi"
                                placeholder="Contoh : Dokter Umum / Kardiologi / Pijat Tulang">
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

                    <div class="mb-3">
                        <label class="form-label">Faskes</label>
                        <div class="position-relative">
                            <select name="faskes_id" id="faskes_id_edit" class='form-control' aria-hidden="true"
                                style='width:100%;'>
                                <option value="">-- PILIH FASKES --</option>
                                @foreach ($faskeses as $faskes)
                                    <option value="{{ $faskes->id }}">{{ $faskes->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Spesialisasi</label>
                        <div class="position-relative">
                            <input type="text" class="form-control" name="spesialisasi" id="spesialisasi_edit"
                                placeholder="Contoh : Dokter Umum / Kardiologi / Pijat Tulang">
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

<script>
    function tambah() {
        $('#modal_tambah').modal('show');
    }

    function hapus(id) {
        $('#form_hapus').attr('action', 'faskes_has_tenaga_kesehatan/' + id);
        $('#modal_hapus').modal('show');
    }

    function edit(id) {
        $.ajax({
                url: "/faskes_has_tenaga_kesehatan/get_data/" + id
            })
            .done(function(data) {
                const faskes_has_tenaga_kesehatan = JSON.parse(data);

                $('#faskes_id_edit').val(faskes_has_tenaga_kesehatan.faskes_id);
                $('#spesialisasi_edit').val(faskes_has_tenaga_kesehatan.spesialisasi);

                $('#form_edit').attr('action', "/faskes_has_tenaga_kesehatan/" + id);
                $('#modal_edit').modal('show');
            });
    }
</script>

<script>
    $(document).ready(function() {

        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(response => response.json())
            .then(provinces => {
                let options = "<option value=''>-- PILIH PROVINSI --</option>";
                provinces.forEach(function(item) {
                    options += "<option value='" + item.id + "'>" + item.name + "</option>";
                });

                $('#provinsi').html(options);
            });

    });


    $('#provinsi').change(function() {
        $('#provinsi_asli').val($(this).val());

        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + $(this).val() + '.json')
            .then(response => response.json())
            .then(regencies => {
                let options = "<option value=''>-- PILIH KOTA --</option>";
                regencies.forEach(function(item) {
                    options += "<option value='" + item.id + "'>" + item.name + "</option>";
                });

                $('#kota').html(options);
            });

    });

    $('#kota').change(function() {
        $('#kota_asli').val($($this).val());
    });
</script>
