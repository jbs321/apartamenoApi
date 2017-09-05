<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware( 'guest' )->except( 'logout' );
	}

	/**
	 * Redirect the user to the GitHub authentication page.
	 *
	 * @return Response
	 */
	public function redirectToProvider( $provider ) {
		if ( ! $provider ) {
			throw new \Exception( "Provider isn't set" );
		}

		return Socialite::with( $provider )->redirect();
	}

	/**
	 * Obtain the user information from GitHub.
	 * @TODO:: add logic to save response from provider
	 * @return Response
	 */
	public function handleProviderCallback( $provider ) {
		$user = Socialite::driver( $provider )->stateless()->user();
		dd( $user );
	}
}
