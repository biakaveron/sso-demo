<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Openid extends Controller_Account {

	/**
	 * @var OpenID
	 */
	protected $_openid;

	protected $_provider;
	protected $_id_required = TRUE;
	protected $_id_key = 'openid_original_identity';
	protected $_identity_key = 'openid_identity';

	protected function _login_params()
	{
		$this->_openid = $this->_session->get($this->_identity_key);

		if (empty($this->_openid))
		{
			return array();
		}
		else {
			$this->_openid = unserialize($this->_openid);
		}

		return array(
			// provider name
			'OpenID' . ($this->_provider ? '.'.$this->_provider : ''),
			// openid object
			$this->_openid,
			// identity from user
			$this->_session->get($this->_id_key),
		);
	}

	public function before()
	{
		parent::before();
		$this->_openid = OpenID::factory($this->_provider);
	}

	protected function _do_login()
	{
		if ($this->_openid->mode())
		{
			HTTP::redirect($this->_changed_uri('identify'));
		}

		$in_process = $this->_id_required ? ( ! (array() === $this->request->post())) : TRUE;

		if ($in_process)
		{
			$id = $this->_id_required ? Arr::get($_POST, 'openid_identifier') : NULL;

			$this->_session->set($this->_id_key, $id);
			$url = $this->_changed_uri('identify');
			try {
				$this->_openid->returnUrl($url)->login($id);
			}
			catch (HTTP_Exception_302 $e) {
				// its normal behavior for OpenID authentication
				throw $e;
			}
			catch (Exception $e) {
				// @TODO log error info
				$this->_error('Login with ":identity" identity failed', array(':identity' => $id));
				$this->_go_back('account/login');
			}

		}
		else
		{
			$this->template->title = __('Log in with '.($this->_provider ? $this->_provider : 'your').' OpenID provider');
			$this->template->container->content = View::factory('accounts/openid/'.($this->_provider ? strtolower($this->_provider) : 'openid' ));
		}

	}

	public function action_identify()
	{
		if ($this->_openid->complete_login())
		{
			$this->_session->set($this->_identity_key, serialize($this->_openid));
		}
		else {
			$this->_session->delete($this->_identity_key);
		}

		$this->_go_back('account/identify');
	}

}