<?php defined('SYSPATH') OR die('No direct access allowed.');

abstract class Controller_Account extends Controller_Base {

	/**
	 * @return Array
	 */
	abstract protected function _login_params();

	abstract protected function _do_login();

	/**
	 * @var string  Session status key
	 */
	protected $_status_key  = 'SSO_accounting';

	protected $_referer_key = 'SSO_referer';

	public function action_login()
	{
		// where to go for checking account info
		$this->_save_referer('account/identify', $this->_changed_uri('complete'));

		$this->_do_login();
	}

	public function action_complete()
	{
		$params = $this->_login_params();

		if (empty($params) OR call_user_func_array(array($this->_sso, 'login'), $params) === FALSE)
		{
			//Message::custom(array('params' => $params + array('ts' => date('h:i:s'))));
			//Message::notice(__('Authentication failed'));
		}
		else
		{
			//$user = $this->_sso->get_user();
			//Message::success(__('Welcome, :user', array(':user' => $user->username)));
		}

		$this->_go_back('account/login');
	}
}