<style>
.modal-body {
    max-height: 80vh;
    overflow-y: scroll;
    scrollbar-color: #404040 #f1f1f1;
    scrollbar-width: thin;
}
.notification-item:hover { background: #f1f1f1; }
</style>

<!-- Modal notification start -->
<div class="modal fade" id="modal-notification" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center fw-medium"><i class='bx bx-bell me-2'></i><span>Notifikasi</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="container-notifications" class="modal-body p-0">
                @forelse(Auth::user()->notification->sortByDesc('created_at') as $item)
                @if($item->read)
                <div class="notification-item p-3 flex-start gap-3" style="background:#f1f1f1;">
                @else
                <div class="notification-item p-3 flex-start gap-3">
                @endif
                    @if($item->source_user_id)
                    @if($item->sourceUser->picture)
                    <img src="{{asset('img/profiles/'.$item->sourceUser->picture)}}" alt="" class="img-fluid rounded-circle shadow-sm" style="height:80px">
                    @else
                    <img src="{{asset('img/profiles/user.jpg')}}" alt="" class="img-fluid rounded-circle shadow-sm" style="height:80px">
                    @endif
                    @else
                    <div class="flex-center bg-dark rounded-circle text-white" style="height:80px; width:80px;"><i class="bx bx-info-square fs-18"></i></div>
                    @endif
                    <div class="col">
                        <p class="mb-0 fs-8">{!! $item->content !!}</p>
                        <p class="mb-0 fs-8 text-secondary">{{$item->created_at->diffForHumans()}}</p>
                    </div>
                </div>
                @empty
                <p class="p-3 m-0 fs-9 text-center">Tidak ada notifikasi</p>
                @endforelse
            </div>
            <div class="modal-footer">
                <span class="hover-underline pb-1 fs-9 text-darkBlue" role="button" onclick="clearNotification()">Hapus semua</span>
            </div>
        </div>
    </div>
</div>
<!-- Modal notification end -->

@push('scripts')
<script type="text/javascript">
const modalNotification = () => {
  $('.modal').modal('hide');
  axios({
    method: 'post',
    url: domain + 'action/notification',
    data: { action: 'read_all' },
  }).then((res) => {
    $('.notification-count').remove();
    $('#modal-notification').modal('show');
  });
};

const clearNotification = () => {
    let formData = { action: 'clear_notification' };
    let config = { method: 'post', url: domain + 'action/notification', data: formData, };
    axios(config)
    .then((res) => {
        $('#container-notifications').html(`<p class="p-3 m-0 fs-9 text-center">Tidak ada notifikasi</p>`)
    })
    .catch((err) => {
        console.log(err.response.data);
    });
    $('.modal').modal('hide');
};
</script>
@endpush