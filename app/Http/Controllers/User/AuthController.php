<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use App\AuthenticateUser;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    const SUPPORTED_PROVIDERS = ['google'];
    
    /**
     * Redirect the user to their OAuth provider's consent screen, if needful. 
     *
     * @return Response
     */
    public function redirectToProvider(AuthenticateUser $authenticateUser, Request $request, $provider)
    {
        if (in_array($provider, self::SUPPORTED_PROVIDERS) == false)
        {
            throw new Exception('Unsupported OAuth provider requested.');
        }

        return $authenticateUser->execute($request->all(), $this, $provider); 
    } // end redirectToProvider

    public function userHasLoggedIn($user) 
    {
        Session::flash('message', 'Welcome, ' . $user->display_name);
        return redirect('/');
    } // end userHasLoggedIn

    public function getSuspended()
    {
        return view('user.auth.suspended');
    } // end getSuspended
} // end AuthController
