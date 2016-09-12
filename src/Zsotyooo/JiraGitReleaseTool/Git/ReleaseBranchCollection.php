<?php

namespace Zsotyooo\JiraGitReleaseTool\Git;

use Zsotyooo\JiraGitReleaseTool\Config\Config as AppConfig;

class ReleaseBranchCollection extends BranchCollectionAbstract
{
    /**
     * filters the collenction to release branches
     * 
     * @return $this
     */
    protected function _filter()
    {
        $prefix = $this->config->get('git', 'release_branch_prefix');

        $this->branches = array_filter(
            $this->branches,
            function($val) use (&$prefix)
            {
                return (strpos($val, $prefix) === 0);
            }
        );

        usort($this->branches, function($a, $b) use (&$prefix) {
            if ($a == $b) {
                return 0;
            }
            return version_compare(str_replace($prefix, '', $a), str_replace($prefix, '', $b), '<') ? -1 : 1;
        });

        return $this;
    }
}