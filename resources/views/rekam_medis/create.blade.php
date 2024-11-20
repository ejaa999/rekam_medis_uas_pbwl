@extends('layouts.main_layout')

@section('container')
    <div class="container mt-3">
        <div class="card mb-4">
            <h5 class="card-header">

                <a href="{{ url()->previous() }}">
                    <i class='fa fa-arrow-left pe-3'></i>
                </a>

                Tambah Rekam Medis {{ $tipe_rekam_medis == 'tenaga_kesehatan' ? 'dari Tenaga Kesehatan' : 'Personal' }}
            </h5>
            <hr class="my-0">
            <div class="card-body pb-2">

                <form action="/rekam_medis" method='POST' id='form_tambah' onsubmit="return cek_panjang_teks('tambah')"
                    class='dont_disabled' enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="pasien_id" value="{{ $pasien_id }}">

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <div class="position-relative">
                            <input type="date" class="form-control" name="tanggal" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Anamnesa</label>
                        <div class="position-relative">
                            <textarea class="form-control summernote" name="anamnesa" id='anamnesa_tambah' style="height:150px;" required></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Diagnosis</label>
                        <div class="position-relative">
                            <textarea class="form-control summernote" name="diagnosis" id="diagnosis_tambah" style="height:150px;" required></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Terapi</label>
                        <div class="position-relative">
                            <textarea class="form-control summernote" name="terapi" id="terapi_tambah" style="height:150px;" required></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class='form-label'> Tambah Lampiran (Gambar / Audio / Video / PDF)</label>
                        <input type="file" name="lampiran_rekam_medises[]" class='form-control' multiple
                            accept="image/*,audio/*,image/*,.pdf">
                    </div>


                    <div class="form-group" style='text-align:center;'>
                        <button type='submit' class="btn btn-success">Tambah</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        function cek_panjang_teks(tipe) {
            if ($('#anamnesa_' + tipe).val().length > 1000) {
                iziToast.error({
                    title: "Anamnesa terlalu panjang (maks 1000 karakter)",
                    position: 'topCenter'
                });

                return false;
            } else if ($('#diagnosis' + tipe).val().length > 750) {
                iziToast.error({
                    title: "Diagnosis terlalu panjang (maks 750 karakter)",
                    position: 'topCenter'
                });

                return false;
            } else if ($('#terapi_' + tipe).val().length > 750) {
                iziToast.error({
                    title: "Terapi terlalu panjang (maks 750 karakter)",
                    position: 'topCenter'
                });

                return false;
            } else {
                return true;
            }
        }
    </script>
@endsection
