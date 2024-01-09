@extends('layouts.master')

@push('css-styles')
<style>
table { font-size: .8rem; }
.timeline {
  border-left: 1px solid hsl(0, 0%, 90%);
  position: relative;
  list-style: none;
}

.timeline .timeline-item {
  position: relative;
}

.timeline .timeline-item:after {
  position: absolute;
  display: block;
  top: 0;
}

.timeline .timeline-item:after {
  background-color: hsl(0, 0%, 90%);
  left: -38px;
  border-radius: 50%;
  height: 11px;
  width: 11px;
  content: "";
}
@media (max-width: 1199px) {
}
</style>
@endpush

@section('content')

<div class="container my-4">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/keluhanPelanggan">Keluhan pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Keluhan dari {{$keluhanPelanggan->nama}}</li>
            </ol>
        </nav>
    </div>
    <div class="row box">
        <div class="col-md-12 flex-between mb-2">
            <h3 class="flex-start gap-3"><i class="bx bx-message-rounded-dots"></i>Keluhan {{$keluhanPelanggan->nama}}</h3>
        </div>
        <div class="col-md-12">
            <table class="table table-border-bottom fs-9 text-secondary mb-3">
                <tr>
                    <td>Nama</td>
                    <td id="complain-nama">{{$keluhanPelanggan->nama}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td id="complain-email">{{$keluhanPelanggan->email}}</td>
                </tr>
                <tr>
                    <td>Kontak</td>
                    <td id="complain-nomor_hp">{{$keluhanPelanggan->nomor_hp}}</td>
                </tr>
            </table>
            <p id="complain-keluhan" class="mb-3">{{$keluhanPelanggan->keluhan}}</p>
        </div>
        <div class="col-md-12">
            <h5 class="mb-3">Riwayat status keluhan</h5>
            <ul class="timeline">
                @foreach($keluhanPelanggan->history->sortBy('created_at') as $item)
                <li class="timeline-item mb-3">
                    <div class="flex-between gap-3">
                        <span>{{date('d F Y | h:i A', strtotime($item->created_at))}}</span>
                        <hr class="col">
                        @if($item->status_keluhan == 0)
                        <span class="badge bg-success">Received</span>
                        @elseif($item->status_keluhan == 1)
                        <span class="badge bg-warning">In process</span>
                        @elseif($item->status_keluhan == 2)
                        <span class="badge bg-primary">Done</span>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <p class="fs-9 text-secondary mt-3">Input by {{$keluhanPelanggan->user->name}} ({{$keluhanPelanggan->user->email}})</p>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $('#link-complain').addClass('active');
});
</script>
@endpush