<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SSOLoginController extends Controller
{
	/**
	 * SSO Login Provider. Uses Google Auth and Socialite for Laravel for authentication.
	 */

	/**
	 * Redirect the user to the GitHub authentication page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function redirectToProvider()
	{
		return Socialite::driver('google')->with(['hd' => 'tri.be'])->redirect();
	}

	/**
	 * Obtain the user information from GitHub.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function handleProviderCallback()
	{
		$user = Socialite::driver('google')->user();

		echo $user->token; die();
	}

}
