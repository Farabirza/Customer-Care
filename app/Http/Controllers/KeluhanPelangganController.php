<?php

namespace App\Http\Controllers;

use App\Models\KeluhanPelanggan;
use App\Models\KeluhanStatusHis;
use App\Models\User;
use App\Http\Requests\StoreKeluhanPelangganRequest;
use App\Http\Requests\UpdateKeluhanPelangganRequest;

use App\Exports\KeluhanPelangganExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KeluhanPelangganController extends Controller
{
    public function validateError()
    {
        if(isset($validator) && $validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export($format)
    {
        switch($format) {
            case 'pdf':
                return Excel::download(new KeluhanPelangganExport, 'keluhanPelanggan.pdf');
            break;
            case 'txt':
                $keluhanPelanggan = KeluhanPelanggan::orderByDesc('created_at')->get();
                $content = '';
                foreach ($keluhanPelanggan as $item) {
                    $content .= "$item->nama\t$item->email\t$item->nomor_hp\t$item->status_keluhan\r$item->keluhan\r".date('Y/m/d h:i:s', strtotime($item->created_at))."\t".date('Y/m/d h:i:s', strtotime($item->updated_at))."\r\r";
                }
                $filename = 'keluhanPelanggan.txt';
                return response()->make($content, 200, [
                    'Content-Type' => 'text/plain',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                ]);

                return Excel::download(new KeluhanPelangganExport, 'keluhanPelanggan.txt');
            break;
            case 'csv':
                return Excel::download(new KeluhanPelangganExport, 'keluhanPelanggan.csv');
            break;
            case 'xlsx':
                return Excel::download(new KeluhanPelangganExport, 'keluhanPelanggan.xlsx');
            break;
            default: return redirect('/keluhanPelanggan')->with('error', 'Format file tidak didukung'); break;
        }
    }

    public function index()
    {
        return view('complain.index', [
            'title' => 'Customer Care | Keluhan Pelanggan',
            'keluhanPelanggans' => KeluhanPelanggan::orderBy('status_keluhan')->orderByDesc('created_at')->get(),
            'histories' => KeluhanStatusHis::orderByDesc('created_at')->get(),
        ]);
    }

    public function index_api()
    {
        return response()->json([
            'keluhanPelanggans' => KeluhanPelanggan::orderBy('status_keluhan')->orderByDesc('created_at')->get(),
        ], 200);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKeluhanPelangganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKeluhanPelangganRequest $request)
    {
        $this->validateError();
        $complain = Auth::user()->complain()->create($request->validated());
        $complain->history()->create([
            'status_keluhan' => 0,
        ]);
        return response()->json([
            'message' => "Keluhan pelanggan berhasil ditambahkan",
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KeluhanPelanggan  $keluhanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(KeluhanPelanggan $keluhanPelanggan)
    {
        return view('complain.show', [
            'title' => 'Customer Care | ' . $keluhanPelanggan->nama,
            'keluhanPelanggan' => $keluhanPelanggan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KeluhanPelanggan  $keluhanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(KeluhanPelanggan $keluhanPelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKeluhanPelangganRequest  $request
     * @param  \App\Models\KeluhanPelanggan  $keluhanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKeluhanPelangganRequest $request, KeluhanPelanggan $keluhanPelanggan)
    {
        $this->validateError();
        $keluhanPelanggan->update($request->validated());
        return response()->json([
            'message' => "Keluhan pelanggan telah diperbaharui",
        ], 200);
    }

    public function update_status(Request $request, $keluhanPelanggan_id)
    {
        if($request->status_keluhan && $request->status_keluhan >= 0 && $request->status_keluhan <= 2) {
            $keluhanPelanggan = KeluhanPelanggan::find($keluhanPelanggan_id);
            if($request->status_keluhan > $keluhanPelanggan->status_keluhan) {
                if($keluhanPelanggan->status_keluhan == 0 && $request->status_keluhan == 2) {
                    $keluhanPelanggan->history()->create([
                        'status_keluhan' => 1,
                    ]);
                }
                $keluhanPelanggan->update([
                    'status_keluhan' => $request->status_keluhan,
                ]);
                $keluhanPelanggan->history()->create([
                    'status_keluhan' => $request->status_keluhan,
                ]);
                return response()->json([
                    'message' => "Status keluhan oleh ".$keluhanPelanggan->nama." telah diperbaharui menjadi : ".$keluhanPelanggan->status_keluhan,
                ], 200);
            }
        }
        return response()->json([
            'message' => "Update status keluhan tidak berhasil"
        ], 400);
    }
    public function delete_status($keluhanPelanggan_id)
    {
        $keluhanPelanggan = KeluhanPelanggan::find($keluhanPelanggan_id);
        $keluhanPelanggan->update([
            'status_keluhan' => 0,
        ]);
        KeluhanStatusHis::where('keluhan_id', $keluhanPelanggan_id)->where('status_keluhan', 1)->delete();
        KeluhanStatusHis::where('keluhan_id', $keluhanPelanggan_id)->where('status_keluhan', 2)->delete();
        return response()->json([
            'message' => "Status keluhan oleh ".$keluhanPelanggan->nama." telah dihapus",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KeluhanPelanggan  $keluhanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeluhanPelanggan $keluhanPelanggan)
    {
        $keluhanPelanggan->delete();
        return back()->with('success', 'Keluhan berhasil dihapus');
    }
    public function action(Request $request)
    {
        switch($request->action) {
            case 'fetch_keluhanStatusHis':
                $keluhanStatusHis = KeluhanStatusHis::orderByDesc('created_at')->with('complain')->get();
                foreach($keluhanStatusHis as $item) {
                    $date_format = date('Y/m/d | H:i', strtotime($item->created_at));
                    $item->date_format = $date_format;
                }
                return response()->json([
                    'keluhanStatusHis' => $keluhanStatusHis,
                ]);
            break;
            case 'fetch_keluhanPelanggans':
                $keluhanPelanggans = KeluhanPelanggan::orderBy('status_keluhan')->orderByDesc('created_at')->get();
                foreach($keluhanPelanggans as $item) {
                    $date_format = date('Y/m/d | H:i', strtotime($item->created_at));
                    $item->date_format = $date_format;
                }
                return response()->json([
                    'keluhanPelanggans' => $keluhanPelanggans,
                ]);
            break;
            case 'get_keluhanPelanggan':
                $keluhanPelanggan = KeluhanPelanggan::find($request->keluhanPelanggan_id);
                return response()->json([
                    'keluhanPelanggan' => $keluhanPelanggan
                ], 200);
            break;
            case 'update_status':
                $keluhanPelanggan = KeluhanPelanggan::find($request->keluhanPelanggan_id);
                if($keluhanPelanggan->status_keluhan != $request->status_keluhan) {
                    $keluhanPelanggan->update([
                        'status_keluhan' => $request->status_keluhan,
                    ]);
                    $keluhanPelanggan->history()->create([
                        'status_keluhan' => $request->status_keluhan,
                    ]);
                }
                return response()->json([
                    'message' => "Status keluhan telah diperbaharui"
                ], 200);
            break;
        }
    }
}
