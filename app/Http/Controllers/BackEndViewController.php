<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MarkupType;
use App\MarkupValueType;
use App\Vat;

class BackEndViewController extends Controller
{
   public function dashboard(){
       return view('pages.backend.dashboard');
   }

   public function vat(){
       $markups = new MarkupType();

       $valueTypes = new MarkupValueType();

       $vat_types = $markups->fetchTypes();

       $vat_value_types = $valueTypes->fetchTypes();

       $vat = Vat::find(1);

       return view('pages.backend.settings.vats',compact('vat_types', 'vat_value_types','vat'));
   }
}
