<?php

namespace App\Http\Controllers;

use App\Airline;
use App\Markdown;
use Illuminate\Http\Request;

class MarkdownController extends Controller
{

    public function createOrUpdate(Request $r){
        $airlineCode = Airline::getAirlineCodeByName($r->airline);
        if(is_null($airlineCode->name)){
            return 0;
        }
        $r->airlineCode = $airlineCode->name;

        return Markdown::store($r);
    }

    public function getMarkdownById($id){

        $markdown = Markdown::getMarkdownWithId($id);
        $airlineName = Airline::getAirline($markdown->airline_code);

        $markdown->airline_name = $airlineName;
        return $markdown;
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
     * @param  \App\Markdown  $markdown
     * @return \Illuminate\Http\Response
     */
    public function show(Markdown $markdown)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Markdown  $markdown
     * @return \Illuminate\Http\Response
     */
    public function edit(Markdown $markdown)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Markdown  $markdown
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Markdown $markdown)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Markdown  $markdown
     * @return \Illuminate\Http\Response
     */
    public function destroy(Markdown $markdown)
    {
        //
    }
}
