<div class="card mb-4 shadow">
    <h5 class="card-header bg-primary text-white">Lampiran Rekam Medis</h5>
    <div class="card-body">
        <label class="form-label fw-bold">Daftar Lampiran</label>
        <div style="margin-bottom:30px;">
            @if (count($lampiran_rekam_medises) > 0)
                <div class="list-group">
                    @foreach ($lampiran_rekam_medises as $lampiran_rekam_medis)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="/storage/{{ $lampiran_rekam_medis->file_path }}"
                               target="_blank"
                               class="text-decoration-none">
                                <i class="fa fa-file me-2"></i>{{ $lampiran_rekam_medis->original_name }}
                            </a>
                            <button class="btn btn-outline-danger btn-sm"
                                    onclick="konfirm_hapus_lampiran_rekam_medis('{{ $lampiran_rekam_medis->id }}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-warning mt-3">
                    <i class="fa fa-info-circle me-2"></i>Belum ada lampiran ditambahkan
                </div>
            @endif
        </div>

        <form action="/lampiran_rekam_medis" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="rekam_medis_id" value="{{ $rekam_medis->id }}">

            <div class="mb-3">
                <label class="form-label fw-bold">Tambah Lampiran (Gambar / Audio / Video / PDF)</label>
                <input type="file" name="lampiran_rekam_medises[]"
                       class="form-control"
                       multiple accept="image/*,audio/*,video/*,.pdf"
                       id="fileInput">
                <small class="form-text text-muted">Maksimal ukuran file: 10 MB.</small>
            </div>

            <div id="previewContainer" class="mt-3"></div>

            <button class="btn btn-primary">
                <i class="fa fa-upload me-2"></i>Tambah Lampiran Rekam Medis
            </button>
        </form>
    </div>
</div>

<!-- Modal hapus Lampiran Rekam Medis -->
<div class="modal fade" id="modal_hapus_lampiran_rekam_medis" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalHapusLabel">Hapus Lampiran Rekam Medis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus lampiran rekam medis ini?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="POST" id="form_hapus_lampiran_rekam_medis">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash me-2"></i>Hapus
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function konfirm_hapus_lampiran_rekam_medis(lampiran_rekam_medis_id) {
        const form = document.getElementById('form_hapus_lampiran_rekam_medis');
        form.action = `/lampiran_rekam_medis/${lampiran_rekam_medis_id}`;
        const modal = new bootstrap.Modal(document.getElementById('modal_hapus_lampiran_rekam_medis'));
        modal.show();
    }

    document.getElementById('fileInput').addEventListener('change', function (event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('previewContainer');
        previewContainer.innerHTML = '';

        Array.from(files).forEach(file => {
            const listItem = document.createElement('div');
            listItem.className = 'alert alert-secondary d-flex align-items-center';

            const fileType = file.type.startsWith('image') ? 'fa-file-image'
                : file.type.startsWith('audio') ? 'fa-file-audio'
                : file.type.startsWith('video') ? 'fa-file-video'
                : 'fa-file-pdf';

            listItem.innerHTML = `<i class="fa ${fileType} me-3"></i>${file.name}`;
            previewContainer.appendChild(listItem);
        });
    });
</script>
