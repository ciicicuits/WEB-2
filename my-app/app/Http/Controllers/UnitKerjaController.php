<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
   public function index()
    {

        $units = UnitKerja::all();
      return view('unit-kerja.index', compact('units'));  
    }
}
