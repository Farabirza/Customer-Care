<style>
.modal-body {
    max-height: 80vh;
    overflow-y: scroll;
    scrollbar-color: #404040 #f1f1f1;
    scrollbar-width: thin;
}
.message-item:hover { background: #f1f1f1; }
</style>

<!-- Modal message start -->
<div class="modal fade" id="modal-message" aria-hidden="true"> 
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center fw-medium"><i class='bx bx-envelope-open me-2'></i><span>Pesan</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <p class="mb-0 fs-9 text-darkBlue">Pengirim</p>
                    <p class="mb-0 fs-9 fw-500" id="modal-message-sender"></p>
                </div>
                <div class="mb-3">
                    <p class="mb-0 fs-9 text-darkBlue">Konten</p>
                    <p class="mb-0 fs-9" id="modal-message-content"></p>
                </div>
            <div>
        </div>
    </div>
</div>
<!-- Modal message end -->

@push('scripts')
<script type="text/javascript">
const deleteMessage = (message_id, item_id) => {
    let formData = { action: 'delete_message', message_id: message_id, };
    let config = { method: 'post', url: domain + 'action/message', data: formData };
    Swal.fire({
        title: 'Anda ingin menghapus pesan ini?',
        icon: 'info',
        text: $(this).attr('data-warning'),
        showCancelButton: true,
        cancelButtonText: 'Batalkan',
        confirmButtonColor: '#dc143c',
        confirmButtonText: "Hapus"
        }).then((result) => {
        if(!result.isConfirmed) {
            return false;
        }
        axios(config)
        .then((res) => {
            $('#message-item-'+item_id).remove();
            if(res.data.message_count == 0) {
                $('#tbody-message').html(`<tr><td colspan="100%" class="text-center fs-9">Tidak ada pesan masuk</td></td>`);
            }
        })
        .catch((err) => {
            console.log(err.response.data);
        });
    });
};
const modalMessage = (message_id, item_id) => {
    let formData = { action: 'get_message', message_id: message_id, };
    let config = { method: 'post', url: domain + 'action/message', data: formData };
    axios(config)
    .then((res) => {
        $('#message-item-'+item_id).addClass('table-active');
        $('#message-icon-'+item_id).removeClass('bx-envelope text-primary').addClass('bx-envelope-open');
        $('#modal-message-sender').html(res.data.message.full_name + ' | ' + res.data.message.email);
        $('#modal-message-content').html(res.data.message.content);
        $('#modal-message').modal('show');
    })
    .catch((err) => {
        console.log(err.response.data);
    });
};
</script>
@endpush