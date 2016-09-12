<?php

namespace Zsotyooo\JiraGitReleaseTool\Api\Jira;

use GuzzleHttp\Client as GuzzleClient;
use Zsotyooo\JiraGitReleaseTool\Config\Config as AppConfig;
use Zsotyooo\JiraGitReleaseTool\Api\Jira\Client as JiraApiClient;
use Zsotyooo\JiraGitReleaseTool\Jira\TicketData as JiraTicketData;

/**
 * Fetch ticket from JIRA
 */
class TicketFetcher
{
    private $client;

    private $config;
    
    public function __construct($config)
    {
        $this->client = new JiraApiClient($config);
        $this->config = $config;
    }

    /**
     * get the ticket
     * 
     * @param  [type] $ticket [description]
     * @return Zsotyooo\JiraGitReleaseTool\Jira\TicketData
     */
    public function getTicket($ticket)
    {
        $data = $this->client->get(
            sprintf($this->config->get('jira', 'ticket_fetch_url'), $ticket),
            [
                'query' => [
                    'fields' => 'summary,status'
                ]
            ]
        );
        return new JiraTicketData($data);
    }
}