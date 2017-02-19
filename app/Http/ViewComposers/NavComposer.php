<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NavComposer
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function compose(View $view)
    {
        $routeAction = $this->request->route()->getAction();

        if (array_key_exists('prefix', $routeAction) == true) {
            $view->with('active_menu', $routeAction['prefix']);
        }
    } // end compose
} // end ActiveMenuComposer
