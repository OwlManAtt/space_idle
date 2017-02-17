<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HarvestController extends Controller
{
    public function getOverview(Request $request)
    {
        $resources = $request->user()->resources()->get();
        return view('harvest.overview', ['resources' => $resources]);
    } // end getOverview
} // end HarvestController 
