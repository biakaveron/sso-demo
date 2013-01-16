<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Openid_Wordpress extends Controller_Openid {

	protected $_provider = 'Wordpress';

	public $login_template = 'auth/openid/wordpress';

}