<?php

namespace App\Http\Controllers;

use App\Models\KeluhanPelanggan;
use App\Models\KeluhanStatusHis;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $keluhanPelanggans = KeluhanPelanggan::orderBy('status_keluhan')->orderByDesc('created_at')->get();
        $keluhanStatusHis = KeluhanStatusHis::whereMonth('created_at', '>', strtotime('six month ago'))->whereMonth('created_at', '<=', date('Y-m-d h:i:s'))->orderBy('status_keluhan')->orderByDesc('created_at')->with('complain')->get();
        
        $monthsArray = [];
        for($i = 5; $i >= 0; $i--) {
            $month = date('F', strtotime("first day of -$i month"));
            $monthsArray[] = $month;
        }
        $statusKeluhanArray = [];
        foreach($monthsArray as $i => $month) {
            $statusKeluhanArray[0][$i] = 0;
            $statusKeluhanArray[1][$i] = 0;
            $statusKeluhanArray[2][$i] = 0;
            foreach($keluhanStatusHis as $item) {
                $itemMonth = date('F', strtotime($item->created_at));
                if($month == $itemMonth) {
                    $statusKeluhanArray[$item->status_keluhan][$i] += 1;
                }
            }
        }
        // dd($keluhanStatusHis);

        return view('dashboard.index', [
            'keluhanPelanggans' => $keluhanPelanggans,
            'keluhanStatusHis' => $keluhanStatusHis,
            'statusKeluhanArray' => $statusKeluhanArray,
        ]);
    }
}
