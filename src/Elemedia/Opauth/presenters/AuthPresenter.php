<?php


class AuthPresenter extends BasePresenter
{
	protected $config = array();

	public function actionAuth($strategy = NULL)
	{
		if($strategy == 'fake') {
			$fakeLogin = array(
				'uid' => "123123123",
				'info' => array(
					'name' => "Chuck Norris",
					'image' => "http://placekitten.com/465/465",
				),
				'raw' => array(
					'link' => "http://www.google.com/search?q=chuck+norris",
					'email' => "gmail@chucknorris.com",
					'given_name' => "Chuck",
					'family_name' => "Norris",
				),
				'provider' => 'Google'
			);

			$identity = \Elemedia\Opauth\Opauth::createIdentity($fakeLogin);
			$this->user->login($identity);

			$this->redirect($this->context->parameters['auth']['login_action']);
			return;
		}

		new Opauth($this->context->parameters['auth']);
		$this->terminate();
	}


	public function actionCallback()
	{
		$Opauth = new Opauth($this->context->parameters['auth'], false);

		$response = null;

		switch ($Opauth->env['callback_transport']) {
			case 'session':				
				$response = $_SESSION['opauth'];
				unset($_SESSION['opauth']);
				break;
			case 'post':
				$response = unserialize(base64_decode($_POST['opauth']));
				break;
			case 'get':
				$response = unserialize(base64_decode($_GET['opauth']));
				break;
			default:
				throw new InvalidArgumentException("Unsupported callback transport.");
				break;
		}
		
		file_put_contents(WWW_DIR.'/../log/response.log', print_r($response, true), FILE_APPEND);

		if (array_key_exists('error', $response)) {
			throw new Exception($response['message']);
		}

		if (empty($response['auth']) || empty($response['timestamp']) || empty($response['signature']) || empty($response['auth']['provider']) || empty($response['auth']['uid'])) {
			throw new Exception('Invalid auth response: Missing key auth response components');
		} elseif (!$Opauth->validate(sha1(print_r($response['auth'], true)), $response['timestamp'], $response['signature'], $reason)) {
			throw new Exception('Invalid auth response: ' . $reason);
		}

		\Nette\Diagnostics\Debugger::barDump($response['auth'], 'authInfo');

		$identity = \Elemedia\Opauth\Opauth::createIdentity($response['auth']);

		$this->context->user->login($identity);
		$this->redirect($this->context->parameters['auth']['login_action']);
	}

	public function actionLogout()
	{
		$this->getUser()->logout(TRUE);
		$this->redirect($this->context->parameters['auth']['logout_action']);
	}
}
