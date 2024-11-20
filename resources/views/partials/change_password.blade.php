{{-- modal change password --}}

<div class="modal" tabindex="-1" id='modal_change_password'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/change_password" method='POST' id='form_ubah_password'>
                    @csrf

                    <div class="form-group">
                        <label>PASSWORD LAMA *</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa fa-arrow-right"></i>
                            </span>
                            <input type="password" class="form-control input_change_password" name="password_lama"
                                required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>PASSWORD BARU *</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa fa-arrow-right"></i>
                            </span>
                            <input type="password" class="form-control input_change_password" id="password_baru"
                                name="password_baru" required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>KONFIRMASI PASSWORD BARU *</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa fa-arrow-right"></i>
                            </span>
                            <input type="password" class="form-control input_change_password"
                                id="konfirmasi_password_baru" name="konfirmasi_password_baru" required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="checkbox-show-password">
                                <label class="form-check-label" for="checkbox-show-password">
                                    Perlihatkan Password
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style='text-align:center;'>
                        <button type='submit' class="btn btn-primary">Ubah</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $('#checkbox-show-password').change(function() {
        if ($(this).is(':checked')) {
            $('.input_change_password').attr('type', 'text');
        } else {
            $('.input_change_password').attr('type', 'password');
        }
    });

    function change_password() {
        $('#modal_change_password').modal('show');
    }
</script>
