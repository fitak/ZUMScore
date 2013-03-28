<?php

use Nette\Application\UI\Control;

class BaseScoreList extends Control
{
    /** @var $userRepository */
    protected $userRepository;
    
    /** @var $scoreRepository */
    protected $scoreRepository;
    
    /** @var $renderGraph */
    protected $renderGraph = true;
    
    /** @var $renderTable */
    protected $renderTable = true;
    
    
    public function __construct($userRepository, $scoreRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->scoreRepository = $scoreRepository;
    }
    
    public function setUserRepository($repository)
    {
        $this->userRepository = $repository;
    }
    
    public function getUserRepository()
    {
        return $this->userRepository;
    }
    
    public function setScoreRepository($repository)
    {
        $this->scoreRepository = $repository;
    }
    
    public function getScoreRepository()
    {
        return $this->scoreRepository;
    }
    
}