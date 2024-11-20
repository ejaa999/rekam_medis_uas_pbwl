<div class="card mb-4">
    <h5 class="card-header">Lampiran Rekam Medis</h5>
    <hr class="my-0">
    <div class="card-body">

        <label class='form-label'> Daftar Lampiran</label>
        <div style='margin-bottom:30px;'>
            @if (count($lampiran_rekam_medises) > 0)
                <ul style='padding-left:0;'>
                    @foreach ($lampiran_rekam_medises as $lampiran_rekam_medis)
                        <ol style='list-style:none;padding-left:0;'>
                            <span>
                                <a href="/storage/{{ $lampiran_rekam_medis->file_path }}"
                                    target="_blank">{{ $lampiran_rekam_medis->original_name }}</a>
                                <button style='background-color:rgba(0,0,0,0);border: 0px solid black;color:inherit;'
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

        <form action="/lampiran_rekam_medis" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class='form-label'> Tambah Lampiran (Gambar / Audio / Video / PDF)</label>
                <input type="hidden" name="rekam_medis_id" value="{{ $rekam_medis->id }}">
                <input type="file" name="lampiran_rekam_medises[]" class='form-control' multiple
                    accept="image/*,audio/*,image/*,.pdf">
            </div>

            <button class='btn btn-primary'>Tambah Lampiran Rekam Medis</button>
        </form>

    </div>

</div>


{{-- modal hapus Lampiran Rekam Medis --}}
<div class="modal" id='modal_hapus_lampiran_rekam_medis'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Lampiran Rekam Medis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin hapus lampiran rekam medis ini?
            </div>
            <div class="modal-footer">
                <form action="diisi_dari_js" method='POST' id='form_hapus_lampiran_rekam_medis'>
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
    function konfirm_hapus_lampiran_rekam_medis(lampiran_rekam_medis_id) {
        $('#form_hapus_lampiran_rekam_medis').attr('action', '/lampiran_rekam_medis/' + lampiran_rekam_medis_id);
        $('#modal_hapus_lampiran_rekam_medis').modal('show');
    }
</script>
