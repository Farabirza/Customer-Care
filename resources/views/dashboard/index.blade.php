@extends('layouts.master')

@push('css-styles')
<style>
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
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="box">
                <div class="mb-2 px-2">
                    <h3 class="flex-start gap-3"><i class="bx bxs-pie-chart-alt-2"></i>Keluhan Pelanggan Berdasarkan Status</h3>
                </div>
                <div class="px-2">
                    <canvas id="piechart-keluhanPelanggan" style="max-height: 420px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="box">
                <div class="mb-2 px-2">
                    <h3 class="flex-start gap-3"><i class='bx bxs-bar-chart-alt-2' ></i>Status Keluhan 6 Bulan Terakhir</h3>
                </div>
                <div class="px-2">
                    <canvas id="barchart-keluhanStatusHis" style="max-height: 420px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="box">
                <div class="mb-2 px-2">
                    <h3 class="flex-start gap-3"><i class="bx bx-table"></i>Top 10 Keluhan</h3>
                </div>
                <div class="px-2">
                    <table class="table table-striped fs-8">
                        <thead>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Umur keluhan</th>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @forelse($keluhanPelanggans->sortBy('created_at') as $item)
                            <tr>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{date('Y-m-d | h:i', strtotime($item->created_at))}}</td>
                                <?php $diff = strtotime('now')-strtotime($item->created_at); ?>
                                <td>{{ abs(round($diff / 86400)) }}</td>
                            </tr>
                            <?php $i++; ?>
                            @if($i == 10) @php break; @endphp @endif
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('/vendor/chartjs/chartjs-4.3.3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/vendor/chartjs/chartjs-plugin-datalabels-2.0.0.min.js') }}"></script>
<script type="text/javascript">
const keluhanPelanggans = @json($keluhanPelanggans);
const keluhanStatusHis = @json($keluhanStatusHis);
var count_received = 0; var count_process = 0; var count_done = 0;
keluhanPelanggans.forEach((item, index) => {
    if(item.status_keluhan == 0) {
        count_received++;
    }
    if(item.status_keluhan == 1) {
        count_process++;
    }
    if(item.status_keluhan == 2) {
        count_done++;
    }
});
const piechartContainer = document.getElementById('piechart-keluhanPelanggan');
var piechart = new Chart(piechartContainer, {
    type: 'pie',
    data: {
        labels: [
        'Received',
        'In process',
        'Done',
    ],
    datasets: [{
        label: ' ',
        data: [count_received, count_process, count_done],
        backgroundColor: [
        '#ff6384',
        'rgb(255, 205, 86)',
        'rgb(54, 162, 235)',
        ],
        hoverOffset: 4
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
            },
            datalabels: {
                color: 'blue',
            },
        }
    }
});

let currentDate = new Date();
let monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
let monthsArray = Array.from({ length: 6 }, (_, index) => {
  let monthIndex = currentDate.getMonth() - index;
  let adjustedDate = new Date(currentDate);
  adjustedDate.setMonth(monthIndex);
  return monthNames[adjustedDate.getMonth()];
});

const statusKeluhanArray = @json($statusKeluhanArray);
console.log(statusKeluhanArray);
const barchartContainer = document.getElementById('barchart-keluhanStatusHis');
var barchart = new Chart(barchartContainer, {
    type: 'bar',
    data: {
        labels: monthsArray.reverse(),
    datasets: [{
        label: 'Received',
        data: statusKeluhanArray[0],
        backgroundColor: [
        '#ff6384',
        ],
        hoverOffset: 4
        },{
        label: 'Process',
        data: statusKeluhanArray[1],
        backgroundColor: [
        'rgb(255, 205, 86)',
        ],
        hoverOffset: 4
        },{
        label: 'Done',
        data: statusKeluhanArray[2],
        backgroundColor: [
        'rgb(54, 162, 235)',
        ],
        hoverOffset: 4
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
            },
            datalabels: {
                color: 'blue',
            },
        }
    }
});
$(document).ready(function(){
    $('#link-dashboard').addClass('active');
});
</script>
@endpush