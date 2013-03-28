<?php

use Nette\Application\UI;

/**
 * Description of ScorePresenter
 *
 * @author Jenda
 */

class UserPresenter extends BasePresenter
{
    /** @var ZUMStats\ScoreRepository */
    private $scoreRepository;
    
    /** @var ZUMStats\UsersRepository */
    private $usersRepository;

    protected function startup()
    {
        parent::startup();
        $this->scoreRepository = $this->context->scoreRepository;
        $this->usersRepository = $this->context->usersRepository;
        
        $uid = $this->getParameter('id');
        $this->template->username = $this->usersRepository->getUserDetails($uid);
    }
    
    public function renderDefault()
    {
        $this->redirect("detail");
    }

    public function renderProfile($id)
    {
        $this->template->userId = $id;
        $this->template->scores = $this->scoreRepository->getUserResults($id);
        $this->template->chart = $this->scoreRepository->getUserChart($id);
    }
    
    public function renderDetail()
    {
        $this->template->scores = $this->scoreRepository->findTop();
    }
    
    public function renderPassword()
    {
        
    }
    
    public function createComponentChangePasswordForm()
    {
        $form = new UI\Form();
        
        $form->setRenderer(new \Kdyby\BootstrapFormRenderer\BootstrapRenderer());
        
        $form->addPassword("newPassword", "Nové heslo");
        $form->addPassword("newPassword2", "Nové heslo podruhé");
        
        $form->addSubmit("change", "Uložit");
        
        $form->onValidate[] = callback($this, "passwordChangeValidate");
        $form->onSuccess[] = callback($this, "passwordChangeSuccess");
        
        return $form;
    }
    
    public function passwordChangeValidate(UI\Form $form)
    {
        $values = $form->getValues();
        
        if(strlen($values->newPassword) < 6)
        {
            $form->addError("Heslo je příliš krátké.");
            return false;
        }
        
        if($values->newPassword != $values->newPassword2)
        {
            $form->addError("Hesla se neshodují!");
            return false;
        }
        
        return true;
    }
    
    public function passwordChangeSuccess(UI\Form $form)
    {
        $values = $form->getValues();
        
        $this->usersRepository->changePassword($this->getUser()->getId(), $values->newPassword);
        
        $this->flashMessage("Heslo bylo změněno.");
        $this->redirect("Score:");
    }
    
    public function createComponentUserScoreList() {
        $control = new \UserScoreList($this->usersRepository, $this->scoreRepository);
        
        return $control;
    }
    
}
?>
