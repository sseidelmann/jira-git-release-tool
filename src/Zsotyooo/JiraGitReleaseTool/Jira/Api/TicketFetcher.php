<?php

namespace Zsotyooo\JiraGitReleaseTool\Jira\Api;

use GuzzleHttp\Client as GuzzleClient;
use Zsotyooo\JiraGitReleaseTool\JiraRestApi\Client as JiraApiClient;
use Zsotyooo\JiraGitReleaseTool\Jira\TicketData as JiraTicketData;

/**
 * Fetch ticket from JIRA
 */
interface TicketFetcher
{
    /**
     * get the ticket
     * 
     * @param  string $ticket [description]
     * @return JiraTicketData
     */
    public function getData($ticket);
}