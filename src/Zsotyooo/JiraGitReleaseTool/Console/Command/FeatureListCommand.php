<?php

namespace Zsotyooo\JiraGitReleaseTool\Console\Command;

/**
 * List Branches and Ticket info
 */
class FeatureListCommand extends AbstractCommand
{
    protected $name = "Feature List";

    
    protected function configure()
    {
        $this
            ->setName('feature:list')
            ->setDescription('list all branches with matching JIRA ticket info')
            ->setHelp('This command lists all branches (git branch -r) with matching JIRA ticket info')
        ;
    }
}