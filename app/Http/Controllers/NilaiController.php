<?php

namespace App\Http\Controllers;

use App\Kandidat;
use App\Nilai;
use App\Kriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use stdClass;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $kandidat = Kandidat::all();
        $kriteria = Kriteria::all();
        return view('nilai.index', [
            'kandidat' => $kandidat,
            'kriteria' => $kriteria
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $kandidat = Kandidat::find($id);
        $kriteria = Kriteria::all();
        return view('nilai.tambah', [
            'master_kriteria' => $kriteria,
            'kandidat' => $kandidat
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data = $request->except('_token');

        $kandidat_id = $data['kandidat_id'];
        $kriteria_id = $data['kriteria_id'];
        foreach ($kriteria_id as $key => $value) {
            echo $key . ' - ' . $value . '<br>';
            $objData = new stdClass();
            $objData->kandidat_id = $id;
            $objData->kriteria_id = $key;
            $objData->nilai = $value;
            $objArray[] = $objData;
        }
        foreach ($objArray as $data) {
            Nilai::create([
                'kandidat_id' => $data->kandidat_id,
                'kriteria_id' => $data->kriteria_id,
                'nilai' => $data->nilai
            ]);
        }
        // $mahasiswa = Mahasiswa::find($id);
        // var_dump($mahasiswa);exit;
        // $mahasiswa->crip()->sync($data);
        return redirect(route('nilai'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kandidat = Kandidat::find($id);
        // echo '<br>$mahasiswa: ' . json_encode($mahasiswa);
        // echo '<br>$mahasiswa->nilai: ' . json_encode($mahasiswa->nilai);exit;
        // $nilai = Kriteria::all()->nilai();
        $kriteria = Kriteria::all();
        // foreach ($mahasiswa )
        return view('nilai.edit', [
            'kriteria' => $kriteria,
            'kandidat' => $kandidat,
            // 'nilai' => $nilai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $nilai_id = $data['id_nilai'];
        $kriteria_id = $data['kriteria_id'];
        foreach ($nilai_id as $nilai) {
            $nilaiData = new stdClass();
            $nilaiData->id = $nilai;
            $nilaiArray[] = $nilaiData;
        }
        // echo json_encode($nilaiArray);
        // echo '<br>';
        $i = 0;
        foreach ($kriteria_id as $key => $value) {
            $objData = new stdClass();
            $objData->id_nilai = $nilaiArray[$i]->id;
            $objData->kandidat_id = $id;
            $objData->kriteria_id = $key;
            $objData->nilai = $value;
            $objArray[] = $objData;
            $i++;
        }
        // echo json_encode($objArray);exit;
        foreach($objArray as $data) {
            $save = Nilai::find($data->id_nilai);
            $save->nilai = $data->nilai;
            $save->save();
        }        
        return redirect(route('nilai'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        //
    }
}
