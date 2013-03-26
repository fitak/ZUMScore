<?php

use Nette\Application\UI;
use Kdyby\BootstrapFormRenderer\BootstrapRenderer;

/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{
   /** @var ZUMStats\UsersRepository */
    private $usersRepository;

        protected function startup()
        {
            parent::startup();
            $this->usersRepository = $this->context->usersRepository;
        }
        
	public function createComponentLoginForm()
	{
		$form = new UI\Form();

                $form->setRenderer(new BootstrapRenderer());
                                
		$form->addText('username', 'Username:')
			->setRequired('Prosím zadejte uživatelské jméno.');

		$form->addPassword('password', 'Heslo:')
			->setRequired('Prosím zadejte heslo.');

		$form->addCheckbox('remember', 'Zůstat přihlášen');

		$form->addSubmit('send', 'Sign in')->setAttribute('class', 'btn-primary btn-large');

		$form->onSuccess[] = callback($this, 'signInFormSucceeded');
		return $form;
	}

	public function signInFormSucceeded(UI\Form $form)
	{
		$values = $form->getValues();

		if ($values->remember) {
			$this->getUser()->setExpiration('+ 14 days', FALSE);
		} else {
			$this->getUser()->setExpiration('+ 20 minutes', TRUE);
		}

		try {
			$this->getUser()->login($values->username, $values->password);
		} catch (Nette\Security\AuthenticationException $e) {
                        $form->addError($e->getMessage());
			return;
		}

		$this->redirect('Score:');
	}

        public function createComponentActivateForm()
	{
		$form = new UI\Form();

                $form->setRenderer(new BootstrapRenderer());
                                
		$form->addText('username', 'Username:')
			->setRequired('Zadejte uživatelské jméno.');

		$form->addSubmit('send', 'Aktivovat')->setAttribute('class', 'btn-primary btn-large');

		$form->onSuccess[] = callback($this, 'activateFormSucceeded');
		return $form;
	}
        
        public function activateFormSucceeded(UI\Form $form)
	{
		$values = $form->getValues();

                try
                {
                    $password = $this->usersRepository->activateAccount($values->username);
                }
                catch(Exception $e)
                {
                    $this->flashMessage("Při aktivaci se vyskytla chyba... Naprd... (".$e->getMessage().")", 'error');
                    $this->redirect('Sign:activate');
                }
                
                $this->flashMessage("Vygenerované heslo: ".$password." - po přihlášení lze změnit");
                
		$this->redirect('Sign:in');
	}
        
        public function actionActivate()
        {
            
        }
        
	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}

}
