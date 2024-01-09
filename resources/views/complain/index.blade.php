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
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Keluhan pelanggan</li>
            </ol>
        </nav>
    </div>
    <div class="row box">
        <div class="col-md-12 flex-between mb-2">
            <h3 class="flex-start gap-3"><i class="bx bx-message-rounded-dots"></i>Daftar keluhan</h3>
            <button class="btn" onclick="modalComplain('create')"><span class="pb-1 hover-underline">Buat keluhan baru</span></button>
        </div>
        <div class="col-md-12">
            <table class="table table-striped" id="table-keluhanPelanggan">
                <thead class="text-primary">
                    <th>Waktu</th>
                    <th>Id</th>
                    <th>Nama pelanggan</th>
                    <th>Status</th>
                    <th>Menu</th>
                </thead>
                <tbody id="tbody-keluhanPelanggan">
                    @forelse($keluhanPelanggans as $i => $item)
                    <tr>
                        <td>{{date('Y/m/d | H:i', strtotime($item->created_at))}}</td>
                        <td>{{$item->id}}</td>
                        <td>{{$item->nama}}</td>
                        <td>
                            @if($item->status_keluhan == 0)
                            <span class="badge bg-success">Received</span>
                            @elseif($item->status_keluhan == 1)
                            <span class="badge bg-warning">In process</span>
                            @elseif($item->status_keluhan == 2)
                            <span class="badge bg-primary">Done</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <i class="bx bx-dots-vertical rounded-circle btn-outline-dark p-1" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <div class="dropdown-menu fs-10">
                                    <div class="dropdown-item"><a href="/keluhanPelanggan/{{$item->id}}">Detail</a></div>
                                    @if($item->status_keluhan != 2)
                                    @if($item->status_keluhan == 0)
                                    <div class="dropdown-item" onclick="modalComplain('edit', '{{$item->id}}')" role="button">Edit data</div>
                                    @endif
                                    <div class="dropdown-item" onclick="modalComplainStatus('{{$item->id}}')" role="button">Ubah status</div>
                                    <div class="dropdown-item">
                                        <form action="/keluhanPelanggan/{{$item->id}}" method="post" class="m-0">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn p-0 fs-10" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            <div class="flex-start gap-3 mt-4">
                <span class="flex-start gap-2 fw-medium text-primary"><i class="bx bx-export"></i>Export :</span>
                <a href="/keluhanPelanggan/export/xlsx" class="hover-underline">Excel</a>
                <a href="/keluhanPelanggan/export/csv" class="hover-underline">CSV</a>
                <a href="/keluhanPelanggan/export/txt" class="hover-underline">Text</a>
                <a href="/keluhanPelanggan/export/pdf" class="hover-underline">PDF</a>
            </div>
        </div>
    </div>

    @include('layouts.modals.modal_complain')

    <div class="row box mt-4">
        <div class="col-md-12 flex-between mb-2">
            <h3 class="flex-start gap-3"><i class="bx bx-history"></i>Riwayat keluhan</h3>
        </div>
        <div class="col-md-12">
            <table id="table-history" class="table table-striped table-hover">
                <thead class="text-primary">
                    <th>Waktu</th>
                    <th>Nama pelanggan</th>
                    <th>Email</th>
                    <th>Status keluhan</th>
                </thead>
                <tbody id="tbody-history">
                    @forelse($histories as $i => $item)
                    <tr class="clickable-row" data-href="/keluhanPelanggan/{{$item->complain->id}}" role="button">
                        <td>{{date('Y/m/d | H:i', strtotime($item->created_at))}}</td>
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
$(".clickable-row").click(function() {
    window.location = $(this).data("href");
});
$(document).ready(function(){
    $('#link-complain').addClass('active');
    var tableKeluhanPelanggan = new DataTable('#table-keluhanPelanggan', {
        ordering: true,
        searching: true,
        order: [[3, 'desc'], [0, 'desc']],
    });
    var tableKeluhanStatusHis = new DataTable('#table-history', {
        order: [[0, 'desc']],
        searching: true,
    });
});
</script>
@endpush