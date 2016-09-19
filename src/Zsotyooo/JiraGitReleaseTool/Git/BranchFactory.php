<?php

namespace Zsotyooo\JiraGitReleaseTool\Git;

use Zsotyooo\JiraGitReleaseTool\Config\Config as AppConfig;
use Zsotyooo\JiraGitReleaseTool\Git\Branch;

/**
 * Ticket entity
 */
class BranchFactory
{
    private $config;
    
    public function __construct(
        $config
    )
    {
        $this->config = $config;
    }

    public function createBranch($name)
    {
        return new Branch($name, $this->config);
    }
}