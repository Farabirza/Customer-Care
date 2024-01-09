<style>
</style>

<!-- Modal complain -->
<div class="modal" id="modal-complain" aria-hidden="true"> 
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="flex-start gap-2 m-0"><i class='bx bx-message-rounded-dots'></i><span id="modal-complain-title">Keluhan</span></h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x hover-danger"></i>
                </button>
            </div>
            <form action="keluhanPelanggan" id="form-complain" method="POST">
            <input type="hidden" name="_method" id="complain-method" value="">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="complain-nama" class="form-label">Nama</label>
                    <input name="nama" id="complain-nama" type="text" class="form-control" value="">
                    <p id="alert-nama" class="alert alert-danger mt-2 mb-0 fs-9 d-none"></p>
                </div>
                <div class="flex-start gap-3 mb-3">
                    <div class="col">
                        <label for="complain-email" class="form-label">Email</label>
                        <input type="text" name="email" id="complain-email" class="form-control" value="">
                        <p id="alert-email" class="alert alert-danger mt-2 mb-0 fs-9 d-none"></p>
                    </div>
                    <div class="col">
                        <label for="complain-nomor_hp" class="form-label">Kontak</label>
                        <input type="text" name="nomor_hp" id="complain-nomor_hp" class="form-control" value="" placeholder="">
                        <p id="alert-nomor_hp" class="alert alert-danger mt-2 mb-0 fs-9 d-none"></p>
                    </div>
                </div>
                <div class="mb-3">    
                    <label for="complain-keluhan" class="form-label">Keluhan</label>
                    <textarea id="complain-keluhan" name="keluhan" class="form-control" style="min-height:120px" placeholder="Paparkan keluhan pelanggan"></textarea>
                    <p id="alert-keluhan" class="alert alert-danger mt-2 mb-0 fs-9 d-none"></p>
                </div>
                <div id="container-complain-status_keluhan" class="mb-3">
                    <label for="complain-status_keluhan" class="form-label">Status keluhan</label>
                    <select name="status_keluhan" id="complain-status_keluhan" class="form-select">
                        <option value="0">Received</option>
                        <option value="1">In process</option>
                        <option value="2">Done</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary flex-start gap-2">Kirim<i class='bx bxs-chevron-right'></i></button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal complain end -->

@push('scripts')
<script type="text/javascript">

// complain
const modalComplain = (action, keluhanPelanggan_id) => {
    let form = $('#form-complain');
    form.trigger('reset');
    $('.alert').html('').hide();
    if(action == 'create') {
        form.attr('action', 'keluhanPelanggan');
        $('#complain-method').val('post');
        $('#modal-complain-title').html('Buat keluhan baru');
        $('#container-complain-status_keluhan').addClass('d-none');
    } else {
        let config = {
            method: 'post', url: domain + 'action/keluhanPelanggan', data: {
                action: 'get_keluhanPelanggan', keluhanPelanggan_id: keluhanPelanggan_id
            }
        };
        axios(config)
        .then((res) => {
            form.attr('action', 'keluhanPelanggan/'+keluhanPelanggan_id);
            $('#complain-method').val('put');
            // $('#complain-nama').val($('#complain-nama-'+order_id).html());
            // $('#complain-email').val($('#complain-email-'+order_id).html());
            // $('#complain-nomor_hp').val($('#complain-nomor_hp-'+order_id).html());
            // $('#complain-keluhan').val($('#complain-keluhan-'+order_id).html());
            // $('#container-complain-status_keluhan').removeClass('d-none');
            // $('#complain-status_keluhan option[value='+$('#complain-status_keluhan-'+order_id).html()+']').attr('selected','selected');
            $('#modal-complain-title').html('Edit keluhan');
        })
        .catch((err) => {
            errorMessage("Data keluhan tidak ditemukan");
        });
    }
    $('#modal-complain').modal('show');
};

$('#form-complain').submit(function(e) {
    e.preventDefault();
    $('.alert').html('').hide();
    let formData = new FormData($(this)[0]);
    let config = {
        method: $(this).attr('method'), url: domain + $(this).attr('action'), data: formData,
    };
    console.log(config);
    axios(config)
    .then((res) => {
        successMessage(res.data.message);
        $('.modal').modal('hide');
        form.trigger('reset');
    })
    .catch((err) => {
        if(err.response && err.response.data) {
            validationMessage(err.response.data.errors); // available in main.js
        }
    })
});

</script>
@endpush