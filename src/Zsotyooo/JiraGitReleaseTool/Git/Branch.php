<?php

namespace Zsotyooo\JiraGitReleaseTool\Git;

use Zsotyooo\JiraGitReleaseTool\Config\Config as AppConfig;
use Zsotyooo\JiraGitReleaseTool\Shell\GitShell;

class Branch
{
    private $name;

    private $config;

    private $shell;

    private $data;
    
    public function __construct($name, $config)
    {
        $this->config = $config;
        $this->name = trim($name);
        $this->shell = new GitShell($config);
    }

    /**
     * get branch data
     * 
     * @return Zsotyooo\JiraGitReleaseTool\Git\BranchData
     */
    public function getData()
    {
        if (is_null($this->data)) {
            $this->data = new BranchData([
                    'name' => $this->name,
                    'ticket' => $this->_getTicket(),
                    'sha' => ''
                ]);
        }
        return $this->data;
    }

    /**
     * is merget to other branch
     * 
     * @param  Zsotyooo\JiraGitReleaseTool\Git|string  $otherBranch object or branch name
     * @return boolean
     */
    public function isMergedTo($otherBranch)
    {
        if (is_object($otherBranch)) {
            $otherBranch = $otherBranch->getData()->name();
        }
        return (bool) $this->shell->exec('git branch -r --merged ' . $otherBranch . ' | grep ' . $this->getData()->name());
    }

    protected function _getTicket()
    {
        $projects = (array) explode(',', $this->config->get('jira', 'projects'));

        if (!preg_match('/[(' . implode(')|(', $projects) . ')]+-\d+/', $this->name, $matches)) {
            // throw new Exception('Branch ' . $this->name() . ' does not have ticket!');
            return false;
        }
        return $matches[0];
    }
}