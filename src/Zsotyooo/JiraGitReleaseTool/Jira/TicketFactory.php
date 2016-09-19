<?php

namespace Zsotyooo\JiraGitReleaseTool\Jira;

use Zsotyooo\JiraGitReleaseTool\Config\Config as AppConfig;
use Zsotyooo\JiraGitReleaseTool\Jira\Ticket;

/**
 * Ticket entity
 */
class TicketFactory
{
    private $config;

    private $ticketFetcher;
    
    public function __construct(
        $config,
        $ticketFetcher
    )
    {
        $this->config = $config;
        $this->ticketFetcher = $ticketFetcher;
    }

    public function createTicket($key)
    {
        return new Ticket($key, $this->config, $this->ticketFetcher);
    }
}