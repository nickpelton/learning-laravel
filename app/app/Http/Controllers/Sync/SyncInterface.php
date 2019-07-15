<?php

namespace App\Sync\Sync;


/**
 * Class SocialLoginController
 * @package App\Http\Controllers\Auth
 */
Interface SyncInterface {


	public function sync();

	public function process();

	public function index();

	public function init();

}
