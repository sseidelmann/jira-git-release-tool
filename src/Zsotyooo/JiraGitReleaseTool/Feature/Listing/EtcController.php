<?php

namespace Zsotyooo\JiraGitReleaseTool\Feature\Listing;

use Zsotyooo\JiraGitReleaseTool\App\ResultProvider as ResultProviderInterface;
use Zsotyooo\JiraGitReleaseTool\App\Controller\Result;

class EtcController extends ControllerAbstract
{
    protected function _processBranches()
    {
        $config = $this->config;

        foreach ($this->branchCollection->getItems() as $index => $branch) {
            $branchData = $branch->getData();

            $this->data['branches'][$index] = [
                'branch_name' => $branchData->name(),
                'merged_dev' => $branch->isMergedTo($config->get('git', 'test_branch')),
                'merged_release' => $branch->isMergedTo($this->data['latest_release_branch']),
                'merged_master' => $branch->isMergedTo($config->get('git', 'master_branch')),
            ];
        }
    }
}