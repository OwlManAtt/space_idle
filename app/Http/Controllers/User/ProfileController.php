<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getRegister(Request $request)
    {
        return view('user.profile.register', ['user' => $request->user()]);
    } // end getRegister

    public function postRegister(Request $request)
    {
        UserRepository::updateProfile($request->all(), $request->user());

        return redirect($request->user()->homepage());
    } // end postRegister
} // end ProfileController
