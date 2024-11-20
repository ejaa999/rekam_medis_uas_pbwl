<div class="card mb-4">
    <h5 class="card-header">Surat Ijin Praktek</h5>
    <hr class="my-0">
    <div class="card-body">

        <label class='form-label'> Daftar Surat</label>
        <div style='margin-bottom:30px;'>
            @if (count($surat_ijin_prakteks) > 0)
                <ul style='padding-left:0;'>
                    @foreach ($surat_ijin_prakteks as $surat_ijin_praktek)
                        <ol style='list-style:none;padding-left:0;'>
                            <span>
                                <a href="/storage/{{ $surat_ijin_praktek->file_path }}"
                                    target="_blank">{{ $surat_ijin_praktek->original_name }}</a>
                                <button style='background-color:rgba(0,0,0,0);border: 0px solid black;color:inherit;'
                                    onclick="konfirm_hapus_surat_ijin_praktek('{{ $surat_ijin_praktek->id }}')">
                                    <i class='fa fa-trash'></i>
                                </button>
                            </span>
                        </ol>
                    @endforeach
                </ul>
            @else
                <label class='form-label help-block'> Belum ada surat ditambahkan </label>
            @endif
        </div>

        <form action="/surat_ijin_praktek" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class='form-label'> Tambah Surat Ijin Praktek (PDF)</label>
                <input type="file" name="surat_ijin_prakteks[]" class='form-control' multiple
                    accept="application/pdf">
            </div>

            <button class='btn btn-primary'>Tambah Surat Ijin Praktek</button>
        </form>

    </div>

</div>


{{-- modal hapus surat ijin praktek --}}
<div class="modal" id='modal_hapus_surat_ijin_praktek'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Surat Ijin Praktek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin hapus surat ijin praktek ini?
            </div>
            <div class="modal-footer">
                <form action="diisi_dari_js" method='POST' id='form_hapus_surat_ijin_praktek'>
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
    function konfirm_hapus_surat_ijin_praktek(surat_ijin_praktek_id) {
        $('#form_hapus_surat_ijin_praktek').attr('action', '/surat_ijin_praktek/' + surat_ijin_praktek_id);
        $('#modal_hapus_surat_ijin_praktek').modal('show');
    }
</script>
