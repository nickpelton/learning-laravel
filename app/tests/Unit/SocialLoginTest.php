<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\Auth\SocialLoginController;

class SocialLoginTest extends TestCase
{

	private $social;

	public function __construct()
	{
		parent::__construct();

		$this->social = new SocialLoginController();
	}

	/**
	 * Confirm our valid provider check is working
	 *
	 * @return void
	 */
	public function testInvalidProviderTest()
	{
		$this->assertFalse( $this->social->IsAllowedProvider('invalid-provider') );
	}

	/**
	 * Confirm our valid providers return true
	 *
	 * @return void
	 */
	public function testValidProvidersTest()
	{
		$providers = $this->social->getProviders();

		foreach($providers as $provider){
			$this->assertTrue( $this->social->IsAllowedProvider($provider) );
		}
	}
}
