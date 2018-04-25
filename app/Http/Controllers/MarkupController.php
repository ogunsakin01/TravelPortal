<?php

namespace App\Http\Controllers;

use App\Markup;
use App\MarkupType;
use App\MarkupValueType;
use App\Role;
use Illuminate\Http\Request;

class MarkupController extends Controller
{

    public function saveAdminMarkup(Request $r)
    {
        $markup = new Markup();

        $this->validate($r, [
            'role' => 'required',
            'markup_type' => 'required',
            'markup_value_type' => 'required',
            'markup_value' =>'required|numeric'
        ]);

        $response = 0;

        if ($markup->updateOrCreateMarkup($r->all()))
        {
            $response = 1;
        }

        return response()->json($response);




    }

    public function getMarkupById($id){
        return Markup::find($id);
    }

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
     * @param  \App\Markup  $markup
     * @return \Illuminate\Http\Response
     */
    public function show(Markup $markup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Markup  $markup
     * @return \Illuminate\Http\Response
     */
    public function edit(Markup $markup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Markup  $markup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Markup $markup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Markup  $markup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Markup $markup)
    {
        //
    }
}
