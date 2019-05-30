<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Laravel\Socialite\Facades\Socialite as Socialite;

/**
 * Class SocialLoginController
 * @package App\Http\Controllers\Auth
 */
class SocialLoginController extends Controller
{

	private const ALLOWED_PROVIDERS = [
		'google'
	];

	/**
	 * Redirect to Providers Auth
	 *
	 * @throws \Exception If invalid provider provided
	 * @param $provider
	 * @return mixed | Socialite Redirect
	 */
	public function redirect($provider)
	{
		if( ! $this->IsAllowedProvider( $provider ) ){
			//TODO Handle more gracefully later. Probably with a catch, log, and redirect to login
			throw new \Exception('Invalid SSO Provider');
		}

		return Socialite::driver($provider)->redirect();
	}

	/**
	 * On successful 3rd party Auth, callback method that creates the user.
	 *
	 * @throws \Exception If invalid provider provided
	 * @param $provider
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function Callback($provider)
	{

		if( ! $this->IsAllowedProvider( $provider ) ){
			//TODO Handle more gracefully later. Probably with a catch, log, and redirect to login
			throw new \Exception('Invalid SSO Provider');
		}

		// Grab SSO Provider meta
		$userSocial = Socialite::driver($provider)->stateless()->user();

		// Check if users already exists in out Users table
		$user = User::where(['email' => $userSocial->getEmail()])->first();
		if($user){
			// User exits, login and redirect
			Auth::login($user);
		}else{
			// User doesn't exist, create, auth, and redirect
			$newUser = User::create([
				'name'          => $userSocial->getName(),
				'email'         => $userSocial->getEmail(),
				'provider_id'   => $userSocial->getId(),
				'provider'      => $provider,
				'password'		=> md5(time() . rand(1,999) )
			]);
			Auth::login($newUser);
		}
		return redirect('/profile');
	}

	private function IsAllowedProvider($provider): bool {
		return in_array( $provider, $this::ALLOWED_PROVIDERS , true );
	}

}
