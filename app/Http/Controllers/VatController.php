<?php

namespace App\Http\Controllers;

use App\Vat;
use Illuminate\Http\Request;

class VatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vat  $vat
     * @return \Illuminate\Http\Response
     */
    public function show(Vat $vat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vat  $vat
     * @return \Illuminate\Http\Response
     */
    public function edit(Vat $vat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vat  $vat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vat $vat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vat  $vat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vat $vat)
    {
        //
    }

    public function saveVat(Request $r)
    {
        $vat = new Vat();

        $this->validate($r, [
            'vat_type' => 'required',
            'vat_value_type' => 'required',
            'vat_value' =>'required|numeric'
        ]);

        if ($vat->updateOrCreateVat($r->all()))
        {
            $response = 1;
            return response()->json($response);
        }

        $response = 0;
        return response()->json($response);
    }

    public function getVat($type){
        $vat = Vat::find(1);
        $value_type = 0;
        $value = 0;
        if($type == 'flight'){
            $type       = 1;
            $value_type = $vat->flight_vat_type;
            $value      = $vat->flight_vat_value;
        }elseif($type == 'hotel'){
            $type       = 2;
            $value_type = $vat->hotel_vat_type;
            $value      = $vat->hotel_vat_value;
        }elseif($type == 'car'){
            $type       = 3;
            $value_type = $vat->car_vat_type;
            $value      = $vat->car_vat_value;
        }
        elseif($type == 'package'){
            $type       = 4;
            $value_type = $vat->package_vat_type;
            $value      = $vat->package_vat_value;
        }
        return [
            'type' => $type,
            'value_type' => $value_type,
            'value' => $value
        ];

    }


}
