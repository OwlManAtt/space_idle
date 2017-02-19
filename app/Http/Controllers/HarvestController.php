<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HarvestingService;
use App\Repositories\ResourceRepository;
use Illuminate\Support\Facades\Session;
use \Carbon\Carbon;

class HarvestController extends Controller
{
    public function postHarvest(Request $request)
    {
        $params = $request->all();
        $requested_res = $request->user()->resources($params['resources'])->get();

        $harvest_service = new HarvestingService($request->user());
        $resources = $harvest_service->doHarvest($requested_res);

        ResourceRepository::updateResources($resources);
        Session::flash('message', 'You have harvested some resources.');

        return redirect('/harvest');
    } // end postHarvest

    public function getOverview(Request $request)
    {
        $now = Carbon::now(); // so everything is in sync
        $resources = $request->user()->resources;

        $all = $resources->map(function ($r) use ($now) {
            return $r->toArray($now);
        });
        $can_do_any = sizeof($resources->filter(function ($r) use ($now) {
            return $r->isHarvestable($now) == true;
        })) > 0;

        return view('harvest.overview', ['resources' => $all, 'enable_all_btn' => $can_do_any]);
    } // end getOverview
} // end HarvestController
