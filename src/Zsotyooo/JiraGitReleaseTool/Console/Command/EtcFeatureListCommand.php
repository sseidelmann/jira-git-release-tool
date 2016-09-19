<?php

namespace Zsotyooo\JiraGitReleaseTool\Console\Command;

/**
 * List Branches and Ticket info
 */
class EtcFeatureListCommand extends AbstractCommand
{
    protected $name = "Etc List";

    
    protected function configure()
    {
        $this
            ->setName('feature:etc')
            ->setDescription('list all branches without ticket info')
            ->setHelp('This command lists all branches (git branch -r) without JIRA ticket info')
        ;
    }
}