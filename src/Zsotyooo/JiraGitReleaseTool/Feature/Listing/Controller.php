<?php

namespace Zsotyooo\JiraGitReleaseTool\Feature\Listing;

use Zsotyooo\JiraGitReleaseTool\App\ResultProvider as ResultProviderInterface;
use Zsotyooo\JiraGitReleaseTool\App\Controller\Result;

class Controller extends ControllerAbstract
{
    protected function _processBranches()
    {
        $config = $this->config;

        foreach ($this->branchCollection->getItems() as $index => $branch) {
            $branchData = $branch->getData();
            
            $ticket = $this->jiraTicketFactory->createTicket($branchData->ticket());
            $ticketData = $ticket->getData();

            $this->data['branches'][$index] = [
                'branch_name' => $branchData->name(),
                'ticket_key' => $ticketData->key(),
                'ticket_summary' => $ticketData->summary(),
                'ticket_status' => $ticketData->status(),
                'merged_dev' => $branch->isMergedTo($config->get('git', 'test_branch')),
                'merged_release' => $branch->isMergedTo($this->data['latest_release_branch']),
                'merged_master' => $branch->isMergedTo($config->get('git', 'master_branch')),
            ];
        }
    }
}