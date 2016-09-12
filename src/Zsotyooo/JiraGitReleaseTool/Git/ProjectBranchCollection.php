<?php

namespace Zsotyooo\JiraGitReleaseTool\Git;

use Zsotyooo\JiraGitReleaseTool\Config\Config as AppConfig;

/**
 * Collenction of branches for configured projects
 */
class ProjectBranchCollection extends BranchCollectionAbstract
{
    /**
     * filters the branches for configured projects
     * 
     * @return $this
     */
    protected function _filter()
    {
        $projectFilter = (array) explode(',', $this->config->get('jira', 'projects'));

        $this->branches = array_filter(
            $this->branches,
            function($val) use (&$projectFilter)
            {
                foreach ($projectFilter as $projectKey) {
                    if (strpos($val, $projectKey) !== false) {
                        return true;
                    }
                }
                return false;
            }
        );

        return $this;
    }
}