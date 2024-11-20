@extends('layouts.main_layout')

@section('container')
    <div class="container mt-3">
        <div class="card mb-4">
            <h5 class="card-header">

                <a href="{{ url()->previous() }}">
                    <i class='fa fa-arrow-left pe-3'></i>
                </a>

                Detail Rekam Medis
            </h5>
            <hr class="my-0">
            <div class="card-body pb-2">

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <div class="position-relative">
                        <input type="date" class="form-control" name="tanggal" value="{{ $rekam_medis->tanggal }}"
                            disabled>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Anamnesa</label>
                    <div class="position-relative p-2" style="background-color:rgba(0,0,0,0.1);border-radius:10px;">
                        {!! $rekam_medis->anamnesa !!}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Diagnosis</label>
                    <div class="position-relative p-2" style="background-color:rgba(0,0,0,0.1);border-radius:10px;">
                        {!! $rekam_medis->diagnosis !!}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Terapi</label>
                    <div class="position-relative p-2" style="background-color:rgba(0,0,0,0.1);border-radius:10px;">
                        {!! $rekam_medis->terapi !!}
                    </div>
                </div>

                <div class="mb-3">
                    <label class='form-label'> Daftar Lampiran</label>
                    <div style='margin-bottom:30px;'>
                        @if (count($lampiran_rekam_medises) > 0)
                            <ul style='padding-left:0;'>
                                @foreach ($lampiran_rekam_medises as $lampiran_rekam_medis)
                                    <ol style='list-style:none;padding-left:0;'>
                                        <span>
                                            <a href="/storage/{{ $lampiran_rekam_medis->file_path }}"
                                                target="_blank">{{ $lampiran_rekam_medis->original_name }}</a>
                                            <button
                                                style='background-color:rgba(0,0,0,0);border: 0px solid black;color:inherit;'
                                                onclick="konfirm_hapus_lampiran_rekam_medis('{{ $lampiran_rekam_medis->id }}')">
                                                <i class='fa fa-trash'></i>
                                            </button>
                                        </span>
                                    </ol>
                                @endforeach
                            </ul>
                        @else
                            <label class='form-label help-block'> Belum ada lampiran ditambahkan </label>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
