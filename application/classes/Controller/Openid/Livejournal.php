<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Openid_Livejournal extends Controller_Openid {

	protected $_provider = 'Livejournal';

	public $login_template = 'auth/openid/livejournal';

}