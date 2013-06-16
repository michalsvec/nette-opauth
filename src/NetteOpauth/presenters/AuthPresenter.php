<?php

/**
 * Presenter that is handling all oauth requests and callbacks
 *
 * @author Michal Svec <pan.svec@gmail.com>
 */
class AuthPresenter extends BasePresenter
{
	protected $config = array();

	/**
	 * Redirection method to oauth provider
	 *
	 * @param string|NULL $strategy strategy used depends on selected provider - 'fake' for localhost testing
	 */
	public function actionAuth($strategy = NULL)
	{
		$opauth->auth($strategy);
		$this->terminate();
	}


	public function actionCallback()
	{
		$identity = $opauth->callback();
		
		$this->context->user->login($identity);
		$this->redirect($this->context->parameters['auth']['login_action']);
	}

	/**
	 * Basic logout action - feel free to use your own in different presenter
	 */
	public function actionLogout()
	{
		$this->getUser()->logout(TRUE);
		$this->redirect($this->context->parameters['auth']['logout_action']);
	}
}
