<?php

namespace Zsotyooo\JiraGitReleaseTool\JiraRestApi;

use GuzzleHttp\Client as GuzzleClient;
use Zsotyooo\JiraGitReleaseTool\Jira\TicketData as TicketData;

use Zsotyooo\JiraGitReleaseTool\Jira\Api\TicketFetcher as TicketFetcherInterface;
/**
 * Fetch ticket from JIRA
 */
class TicketFetcher
    implements TicketFetcherInterface
{
    private $client;

    private $config;
    
    public function __construct($config, $client)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * get the ticket
     * 
     * @param  string $ticket
     * @return TicketData
     */
    public function getData($ticket)
    {
        $data = $this->client->get(
            sprintf($this->config->get('jira', 'ticket_fetch_url'), $ticket),
            [
                'query' => [
                    'fields' => 'summary,status'
                ]
            ]
        );
        return new TicketData([
            'key' => $data['key'],
            'summary' => $data['fields']['summary'],
            'status' => $data['fields']['status']['name'],
        ]);
    }
}