<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HarvestingService;
use App\Repositories\ResourceRepository;
use Illuminate\Support\Facades\Session;
use \Carbon\Carbon;

class StationController extends Controller
{
    public function getResearch(Request $request)
    {
        return view('station.research', []);
    } // end postHarvest
} // end HarvestController
