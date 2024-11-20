@php
    $ktp_pasien = auth()->user()->ktp_pasien_single_list;
@endphp

<div class="card mb-4">
    <div class="card-header">
        <h5>Data KTP Pasien</h5>
        <div class="alert alert-warning">
            Isilah data lengkap sesuai KTP
        </div>
    </div>
    <hr class="my-0">
    <div class="card-body">

        <form action="/ktp_pasien/{{ $ktp_pasien->id }}" method="POST">
            @method('PUT')
            @csrf

            <div class="row">
                <div class="form-group col-md-6">
                    <label class='form-label'> NIK*</label>
                    <input type="number" name="nik" class='form-control' value='{{ $ktp_pasien->nik }}' required>
                </div>

                <div class="form-group col-md-6">
                    <label class='form-label'> Nama*</label>
                    <input type="text" name="nama" class='form-control' value='{{ $ktp_pasien->nama }}' required>
                </div>

                <div class="form-group col-md-6">
                    <label class='form-label'> Tempat Lahir*</label>
                    <input type="text" name="tempat_lahir" class='form-control'
                        value='{{ $ktp_pasien->tempat_lahir }}' required>
                </div>

                <div class="form-group col-md-6">
                    <label class='form-label'> Tanggal Lahir*</label>
                    <input type="date" name="tanggal_lahir" class='form-control'
                        value='{{ $ktp_pasien->tanggal_lahir }}' required>
                </div>

                <div class="form-group col-md-6">
                    <label class='form-label'> Jenis Kelamin*</label>
                    <select name="jenis_kelamin" class='form-control' required>
                        <option value="1" {{ $ktp_pasien->jenis_kelamin == 1 ? 'selected' : '' }}>Laki Laki
                        </option>
                        <option value="2" {{ $ktp_pasien->jenis_kelamin == 2 ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class='form-label'> Agama*</label>
                    <select name="agama" class='form-control' required>
                        <option value="1" {{ $ktp_pasien->agama == '1' ? 'selected' : '' }}>Islam</option>
                        <option value="2" {{ $ktp_pasien->agama == '2' ? 'selected' : '' }}>Kristen</option>
                        <option value="3" {{ $ktp_pasien->agama == '3' ? 'selected' : '' }}>katolik</option>
                        <option value="4" {{ $ktp_pasien->agama == '4' ? 'selected' : '' }}>Buddha</option>
                        <option value="5" {{ $ktp_pasien->agama == '5' ? 'selected' : '' }}>Hindu</option>
                        <option value="6" {{ $ktp_pasien->agama == '6' ? 'selected' : '' }}>Kong Hu cu</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class='form-label'> Status Perkawinan*</label>
                    <select name="status_perkawinan" class='form-control' required>
                        <option value="1" {{ $ktp_pasien->status_perkawinan == 1 ? 'selected' : '' }}>Belum Kawin
                        </option>
                        <option value="2" {{ $ktp_pasien->status_perkawinan == 2 ? 'selected' : '' }}>Kawin
                        </option>
                        <option value="3" {{ $ktp_pasien->status_perkawinan == 3 ? 'selected' : '' }}>Cerai Hidup
                        </option>
                        <option value="4" {{ $ktp_pasien->status_perkawinan == 4 ? 'selected' : '' }}>Cerai Mati
                        </option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class='form-label'> Golongan Darah*</label>
                    <select name="golongan_darah" class='form-control' required>
                        <option value="0" {{ $ktp_pasien->golongan_darah == 0 ? 'selected' : '' }}>Tidak Tahu
                        </option>
                        <option value="1" {{ $ktp_pasien->golongan_darah == 1 ? 'selected' : '' }}>A</option>
                        <option value="2" {{ $ktp_pasien->golongan_darah == 2 ? 'selected' : '' }}>B</option>
                        <option value="3" {{ $ktp_pasien->golongan_darah == 3 ? 'selected' : '' }}>AB</option>
                        <option value="4" {{ $ktp_pasien->golongan_darah == 4 ? 'selected' : '' }}>O</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class='form-label'> Alamat*</label>
                    <input type="text" name="alamat" class='form-control' value='{{ $ktp_pasien->alamat }}'
                        required>
                </div>

                <div class="form-group col-md-6">
                    <label class='form-label'> Pekerjaan*</label>
                    <input type="text" name="pekerjaan" class='form-control' value='{{ $ktp_pasien->pekerjaan }}'
                        required>
                </div>


                <div class="form-group col-md-6">
                    <label class='form-label'> Kewarganegaraan*</label>
                    <select name="kewarganegaraan" class='form-control' required>
                        <option value="1" {{ $ktp_pasien->kewarganegaraan == 1 ? 'selected' : '' }}>Warga Negara
                            Indonesia</option>
                        <option value="2" {{ $ktp_pasien->kewarganegaraan == 2 ? 'selected' : '' }}>Warga Negara
                            Asing</option>
                    </select>
                </div>

            </div>

            <button class='btn btn-primary'>Update Data KTP</button>
        </form>

    </div>

</div>
