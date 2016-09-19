<?php

namespace Zsotyooo\JiraGitReleaseTool\Feature\Listing;

use Zsotyooo\JiraGitReleaseTool\App\ResultProvider as ResultProviderInterface;
use Zsotyooo\JiraGitReleaseTool\App\Controller\Result;

abstract class ControllerAbstract implements ResultProviderInterface
{
    protected $data = [
        'release_branches' => [],
        'branches' => [],
        'latest_release_branch' => '',
        'projects' => ''
    ];

    protected $config;
    protected $releaseBranchCollection;
    protected $branchCollection;
    protected $jiraTicketFactory;
    protected $dataProcessed;

    public function __construct(
        $config,
        $releaseBranchCollection,
        $branchCollection,
        $jiraTicketFactory
    )
    {
        $this->config = $config;
        $this->releaseBranchCollection = $releaseBranchCollection;
        $this->branchCollection = $branchCollection;
        $this->jiraTicketFactory = $jiraTicketFactory;

        $this->dataProcessed = false;
    }

    abstract protected function _processBranches();

    protected function _processReleases()
    {
        foreach ($this->releaseBranchCollection->getItems() as $index => $branch) {
            $this->data['release_branches'][$index] = [
                'branch_name' => $branch->getData()->name()
            ];
        }

        $this->data['latest_release_branch'] = $branch->getData()->name();
    }

    protected function _processConfig()
    {
        $this->data['projects'] = $this->config->get('jira', 'projects');
    }

    public function getResult()
    {
        if (!$this->dataProcessed) {

            $this->_processConfig();
            $this->_processReleases();
            $this->_processBranches();

            $this->dataProcessed = true;
        }

        return new Result($this->data);
    }
}