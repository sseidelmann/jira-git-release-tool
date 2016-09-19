<?php

namespace Zsotyooo\JiraGitReleaseTool\Git;

use Zsotyooo\JiraGitReleaseTool\Config\Config as AppConfig;
use Zsotyooo\JiraGitReleaseTool\Shell\GitShell;

/**
 * Branch data
 */
class BranchData
{
    private $name;

    private $ticket;

    public function __construct($data)
    {
        $this->name = trim($data['name']);
        $this->ticket = trim($data['ticket']);
        $this->sha = trim($data['sha']);
    }

    /**
     * get the name
     * 
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * get the ticket
     * 
     * @return string
     */
    public function ticket()
    {
        return $this->ticket;
    }
}