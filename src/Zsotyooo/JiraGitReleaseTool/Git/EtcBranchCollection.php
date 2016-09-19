<?php

namespace Zsotyooo\JiraGitReleaseTool\Git;

use Zsotyooo\JiraGitReleaseTool\Config\Config as AppConfig;

/**
 * Collenction of branches for configured projects
 */
class EtcBranchCollection extends BranchCollectionAbstract
{
    protected $location = 'r';
    
    /**
     * filters the branches for configured projects
     * 
     * @return $this
     */
    protected function _filter()
    {
        $prefix = $this->config->get('git', 'release_branch_prefix');
        $master = $this->config->get('git', 'master_branch');
        $develop = $this->config->get('git', 'test_branch');

        $this->branches = array_filter(
            $this->branches,
            function($val) use (&$prefix, &$master, &$develop)
            {
                return
                    (strpos($val, $prefix) === false)
                    && (strpos($val, $master) !== 0)
                    && (strpos($val, $develop) !== 0)
                    && !preg_match('/[A-Z]+-\d+/', $val);
            }
        );

        return $this;
    }
}