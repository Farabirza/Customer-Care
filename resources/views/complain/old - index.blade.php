@extends('layouts.master')

@push('css-styles')
<link href="{{ asset('/vendor/datatables/datatables.min.css') }}" rel="stylesheet">
<style>
table { font-size: .8rem; }
@media (max-width: 1199px) {
}
</style>
@endpush

@section('content')

<div class="container my-4">
    <div class="row box">
        <div class="col-md-12 flex-between mb-2">
            <h3 class="flex-start gap-3"><i class="bx bx-message-rounded-dots"></i>Daftar keluhan</h3>
            <button class="btn" onclick="modalComplain('create')"><span class="pb-1 hover-underline">Buat keluhan baru</span></button>
        </div>
        <div class="col-md-12">
            <div class="accordion accordion-flush" id="container-complain-item">
                @forelse($complains as $i => $item)
                <p id="complain-status_keluhan" class="d-none">{{$item->status_keluhan}}</p>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="complain-item-{{$i}}">
                    <button class="accordion-button collapsed flex-start gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#complain-item-collapse-{{$i}}" aria-expanded="false" aria-controls="complain-item-collapse-{{$i}}">
                        <span>{{date('d F Y', strtotime($item->created_at))}}</span>
                        @if($item->status_keluhan == 0)
                        <span class="badge bg-success">Received</span>
                        @elseif($item->status_keluhan == 1)
                        <span class="badge bg-warning">In process</span>
                        @elseif($item->status_keluhan == 2)
                        <span class="badge bg-primary">Done</span>
                        @endif
                    </button>
                    </h2>
                    <div id="complain-item-collapse-{{$i}}" class="accordion-collapse collapse" aria-labelledby="complain-item-{{$i}}" data-bs-parent="#container-complain-item">
                        <div class="accordion-body">
                            <table class="table table-border-bottom fs-9 text-secondary mb-3">
                                <tr>
                                    <td>Nama</td>
                                    <td id="complain-nama-{{$i}}">{{$item->nama}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td id="complain-email-{{$i}}">{{$item->email}}</td>
                                </tr>
                                <tr>
                                    <td>Kontak</td>
                                    <td id="complain-nomor_hp-{{$i}}">{{$item->nomor_hp}}</td>
                                </tr>
                            </table>
                            <p id="complain-keluhan-{{$i}}" class="mb-3">{{$item->keluhan}}</p>
                            <div class="flex-start gap-4 fs-9">
                                <a href="/keluhanPelanggan/{{$item->id}}" class="hover-underline">Detail</a>
                                @if($item->status_keluhan != 2)
                                @if($item->status_keluhan == 0)
                                <button class="btn p-0" onclick="modalComplain('edit', {{$i}}, '{{$item->id}}')"><span class="hover-underline">Edit</span></button>
                                @endif
                                <form action="/keluhanPelanggan/{{$item->id}}" method="post" class="m-0">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn p-0" type="submit"><span class="hover-underline">Hapus</span></button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-secondary mb-0">Belum ada keluhan dibuat</p>
                @endforelse
            </div>
        </div>
    </div>

    @include('layouts.modals.modal_complain')

    <div class="row box mt-4">
        <div class="col-md-12 flex-between mb-2">
            <h3 class="flex-start gap-3"><i class="bx bx-history"></i>Riwayat keluhan</h3>
        </div>
        <div class="col-md-12">
            <table id="table-history" class="table table-striped">
                <thead>
                    <th>Id</th>
                    <th>Waktu</th>
                    <th>Nama pelanggan</th>
                    <th>Email</th>
                    <th>Status keluhan</th>
                </thead>
                <tbody>
                    @forelse($histories as $i => $item)
                    <tr>
                        <td><a href="/keluhanPelanggan/{{$item->complain->id}}">{{$item->id}}</a></td>
                        <td>{{date('Y/m/d', strtotime($item->created_at))}}</td>
                        <td>{{$item->complain->nama}}</td>
                        <td>{{$item->complain->email}}</td>
                        <td>
                            @if($item->status_keluhan == 0)
                            Received
                            @elseif($item->status_keluhan == 1)
                            In process
                            @elseif($item->status_keluhan == 2)
                            Done
                            @endif
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('/vendor/datatables/datatables.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#link-complain').addClass('active');
    new DataTable('#table-history', {
        ordering: true,
        searching: true,
    });
});
</script>
@endpush