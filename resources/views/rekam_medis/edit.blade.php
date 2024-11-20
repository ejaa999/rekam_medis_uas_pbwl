@extends('layouts.main_layout')

@section('container')
    <div class="container mt-3">
        <div class="card mb-4">
            <h5 class="card-header">

                <a href="{{ url()->previous() }}">
                    <i class='fa fa-arrow-left pe-3'></i>
                </a>

                Edit Rekam Medis {{ $tipe_rekam_medis == 'tenaga_kesehatan' ? 'dari Tenaga Kesehatan' : 'Personal' }}
            </h5>
            <hr class="my-0">
            <div class="card-body pb-2">

                <form action="/rekam_medis/{{ $rekam_medis->id }}" method='POST' id='form_tambah'
                    onsubmit="return cek_panjang_teks('edit')" class='dont_disabled'>
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="pasien_id" value="{{ $pasien_id }}">

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <div class="position-relative">
                            <input type="date" class="form-control" name="tanggal" value="{{ $rekam_medis->tanggal }}"
                                required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Anamnesa</label>
                        <div class="position-relative">
                            <textarea class="form-control summernote" name="anamnesa" id='anamnesa_edit' style="height:150px;" required>{{ $rekam_medis->anamnesa }}</textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Diagnosis</label>
                        <div class="position-relative">
                            <textarea class="form-control summernote" name="diagnosis" id="diagnosis_edit" style="height:150px;" required>{{ $rekam_medis->diagnosis }}</textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Terapi</label>
                        <div class="position-relative">
                            <textarea class="form-control summernote" name="terapi" id="terapi_edit" style="height:150px;" required>{{ $rekam_medis->terapi }}</textarea>
                        </div>
                    </div>

                    <div class="form-group" style='text-align:center;'>
                        <button type='submit' class="btn btn-warning">Edit</button>
                    </div>

                </form>

            </div>
        </div>

        @include('rekam_medis.lampiran_rekam_medis')


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
