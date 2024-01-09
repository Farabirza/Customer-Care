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
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary flex-start gap-2">Kirim<i class='bx bxs-chevron-right'></i></button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal complain end -->

<!-- Modal complainStatus -->
<div class="modal" id="modal-complainStatus" aria-hidden="true"> 
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="flex-start gap-2 m-0"><i class='bx bx-info-square'></i>Status keluhan</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x hover-danger"></i>
                </button>
            </div>
            <form id="form-complainStatus">
            <input type="hidden" name="action" value="update_status">
            <input type="hidden" id="complainStatus-keluhanPelanggan_id" name="keluhanPelanggan_id" value="">
            <div class="modal-body">
                <div id="container-complainStatus-status_keluhan" class="mb-3">
                    <label for="complainStatus-status_keluhan" class="form-label">Status keluhan</label>
                    <select name="status_keluhan" id="complainStatus-status_keluhan" class="form-select">
                        <option value="1">Dalam proses</option>
                        <option value="2">Selesai</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary flex-start gap-2">Update<i class='bx bxs-chevron-right'></i></button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal complainStatus end -->

@push('scripts')
<script type="text/javascript">

const modalComplainStatus = (keluhanPelanggan_id) => {
    $('#complainStatus-keluhanPelanggan_id').val(keluhanPelanggan_id);
    $('#modal-complainStatus').modal('show');
};
$('#form-complainStatus').submit(function(e) {
    e.preventDefault();
    let formData = new FormData($(this)[0]);
    let config = {
        method: 'post', url: domain + 'action/keluhanPelanggan', data: formData,
    };
    axios(config)
    .then((res) => {
        successMessage(res.data.message);
        $('.modal').modal('hide');
        $(this).trigger('reset');
        fetchKeluhanPelanggans();
        fetchkeluhanStatusHis();
    })
    .catch((err) => {
        errorMessage("Data keluhan tidak ditemukan");
    })
});

const modalComplain = (action, keluhanPelanggan_id) => {
    let form = $('#form-complain');
    form.trigger('reset');
    $('.alert').html('').hide();
    if(action == 'create') {
        form.attr('action', 'keluhanPelanggan');
        $('#complain-method').val('post');
        $('#modal-complain-title').html('Buat keluhan baru');
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
            $('#complain-nama').val(res.data.keluhanPelanggan.nama);
            $('#complain-email').val(res.data.keluhanPelanggan.email);
            $('#complain-nomor_hp').val(res.data.keluhanPelanggan.nomor_hp);
            $('#complain-keluhan').val(res.data.keluhanPelanggan.keluhan);
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
    axios(config)
    .then((res) => {
        successMessage(res.data.message);
        $('.modal').modal('hide');
        $(this).trigger('reset');
        fetchKeluhanPelanggans();
        fetchkeluhanStatusHis();
    })
    .catch((err) => {
        if(err.response && err.response.data) {
            validationMessage(err.response.data.errors); // available in main.js
        }
    })
});

const fetchkeluhanStatusHis = () => {
    let config = {
        method: 'post', url: domain + 'action/keluhanPelanggan', data: {
            action: 'fetch_keluhanStatusHis'
        }
    };
    axios(config)
    .then((res) => {
        $('#table-history').DataTable().destroy();
        $('#tbody-history').html('');
        res.data.keluhanStatusHis.forEach((item, index) => {
            let status_keluhan = '';
            switch(item.status_keluhan) {
                case '0': status_keluhan = 'Received'; break;
                case '1': status_keluhan = 'In process'; break;
                case '2': status_keluhan = 'Done'; break;
            }
            $('#tbody-history').append(`
                <tr role="button">
                    <td>${item.date_format}</td>
                    <td><a href="/keluhanPelanggan/${item.complain.id}">${item.complain.nama}</a></td>
                    <td>${item.complain.email}</td>
                    <td>${status_keluhan}</td>
                </tr>
            `);
        });
        $('#table-history').DataTable().order([[0, 'desc']]).draw();
    })
    .catch((err) => {
        console.log(err);
    });
};

const fetchKeluhanPelanggans = () => {
    let config = {
        method: 'post', url: domain + 'action/keluhanPelanggan', data: {
            action: 'fetch_keluhanPelanggans'
        }
    };
    axios(config)
    .then((res) => {
        $('#table-keluhanPelanggan').DataTable().destroy();
        $('#tbody-keluhanPelanggan').html('');
        res.data.keluhanPelanggans.forEach((item, index) => {
            let status_keluhan = ''; let menu = '';
            switch(item.status_keluhan) {
                case '0':
                    status_keluhan = `<span class="badge bg-success">Received</span>`;
                    menu = 
                    `<div class="dropdown-item"><a href="/keluhanPelanggan/${item.id}">Detail</a></div>
                    <div class="dropdown-item" onclick="modalComplain('edit', '${item.id}')" role="button">Edit data</div>
                    <div class="dropdown-item" onclick="modalComplainStatus('${item.id}')" role="button">Ubah status</div>
                    <div class="dropdown-item">
                        <form action="/keluhanPelanggan/${item.id}" method="post" class="m-0">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn p-0 fs-10" type="submit">Hapus</button>
                        </form>
                    </div>`;
                break;
                case '1':
                    status_keluhan = `<span class="badge bg-warning">In process</span>`;
                    menu = 
                    `<div class="dropdown-item"><a href="/keluhanPelanggan/${item.id}">Detail</a></div>
                    <div class="dropdown-item" onclick="modalComplainStatus('${item.id}')" role="button">Ubah status</div>
                    <div class="dropdown-item">
                        <form action="/keluhanPelanggan/${item.id}" method="post" class="m-0">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn p-0 fs-10" type="submit">Hapus</button>
                        </form>
                    </div>`;
                break;
                case '2':
                    status_keluhan = `<span class="badge bg-primary">Done</span>`;
                    menu = 
                    `<div class="dropdown-item"><a href="/keluhanPelanggan/${item.id}">Detail</a></div>
                    <div class="dropdown-item">
                        <form action="/keluhanPelanggan/${item.id}" method="post" class="m-0">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn p-0 fs-10" type="submit">Hapus</button>
                        </form>
                    </div>`;
                break;
            }
            $('#tbody-keluhanPelanggan').append(`
            <tr>
                <td>${item.date_format}</td>
                <td>${item.nama}</td>
                <td>${status_keluhan}</td>
                <td>
                    <div class="dropdown">
                        <i class="bx bx-dots-vertical rounded-circle btn-outline-dark p-1" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                        <div class="dropdown-menu fs-10">${menu}</div>
                    </div>
                </td>
            </tr>
            `);
        });
        $('#table-keluhanPelanggan').DataTable().order([[3, 'desc'], [0, 'desc']]).draw();
    })
    .catch((err) => {
        console.log(err);
    });
};

</script>
@endpush