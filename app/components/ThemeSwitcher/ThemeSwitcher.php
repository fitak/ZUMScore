<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ThemeSwitcher
 *
 * @author Jenda
 */
class ThemeSwitcher extends \Nette\Application\UI\Control {
    private $themeList; 
    
    public function __construct($themeList, $parent = NULL, $name = NULL)
    {
        parent::__construct($parent, $name);
        
        $this->themeList = $themeList;
    }
    
    public function render()
    {
        $template = parent::createTemplate();
        
        $template->setFile(__DIR__."/themeList.latte");
        $template->themeList = $this->themeList;
        
        $template->render();
    }
    
    public function handleSwitchTheme($themeName = NULL)
    {
        
        $theme = $this->getPresenter()->getSession('theme');
        $theme->themeName = $themeName;
        $this->redirect('this');
    }
}

?>
