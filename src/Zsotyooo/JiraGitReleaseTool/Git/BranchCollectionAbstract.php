<?php

namespace Zsotyooo\JiraGitReleaseTool\Git;

use Zsotyooo\JiraGitReleaseTool\Config\Config as AppConfig;
use Zsotyooo\JiraGitReleaseTool\Git\Branch as GitBranch;
use Zsotyooo\JiraGitReleaseTool\Shell\GitShell;

/**
 * Branch collection abstract
 */
abstract class BranchCollectionAbstract
{
    protected $branches;

    protected $config;

    protected $shell;
    
    public function __construct($config)
    {
        $this->config = $config;
        $this->shell = new GitShell($config);
    }

    /**
     * load branches, and filter them
     * 
     * @return $this;
     */
    public function load()
    {
        $output = $this->shell->exec('git branch -r');
        $this->branches = array_map('trim', $output);
        $this->_filter();

        return $this;
    }

    /**
     * get the items
     * 
     * @return array
     */
    public function getItems()
    {
        $this->load();
        return $this->_createItems($this->branches);
    }

    /**
     * create Branch objects for all items
     * 
     * @param  array $items
     * @return array
     */
    protected function _createItems($items)
    {
        $branches = [];
        foreach ($items as $branchName) {
            $branches[] = new GitBranch($branchName, $this->config);
        }
        return $branches;
    }

    /**
     * Implement filters
     * 
     * @return $this;
     */
    abstract protected function _filter();
}