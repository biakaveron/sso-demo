<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_OAuth_Yahoo extends Controller_OAuth {

	/**
	 * @var OAuth_Provider_Yahoo
	 */
	protected $_provider = 'Yahoo';
	/**
	 * @var OAuth_Consumer
	 */
	protected $_consumer;
	/**
	 * @var OAuth_Token
	 */
	protected $_token;
	/**
	 * @var OAuth
	 */
	protected $_oauth;
	protected $_cookie = 'cookie_oauth_yahoo';

	public $name = 'Yahoo';

}