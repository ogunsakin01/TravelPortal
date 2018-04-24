<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MarkupType;
use App\MarkupValueType;
use App\Vat;
use App\Role;
use App\Markdown;

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

    public function markupView()
    {
        $markups = new MarkupType();

        $valueTypes = new MarkupValueType();

        $roles = new Role();

        $markup_types = $markups->fetchTypes();

        $markup_value_types = $valueTypes->fetchTypes();

        $roles = $roles->fetchRolesExceptAdmin();

        return view('pages/backend/settings/markups', compact('markup_types', 'markup_value_types', 'roles'));
    }

    public function index(){
        $markdowns = Markdown::all();
        return view('pages.backend.settings.markdown',compact('markdowns'));
    }

}
