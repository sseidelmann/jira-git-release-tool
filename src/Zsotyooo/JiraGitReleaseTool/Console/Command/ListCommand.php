<?php

namespace Zsotyooo\JiraGitReleaseTool\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zsotyooo\JiraGitReleaseTool\Config\Config as AppConfig;
use Zsotyooo\JiraGitReleaseTool\Jira\Ticket as JiraTicket;
use Zsotyooo\JiraGitReleaseTool\Git\ProjectBranchCollection as GitProjectBranchCollection;
use Zsotyooo\JiraGitReleaseTool\Git\ReleaseBranchCollection as GitReleaseBranchCollection;
use Symfony\Component\Console\Style\SymfonyStyle;
use Zsotyooo\JiraGitReleaseTool\Console\Helper\CommandLineFormatter;

/**
 * List Branches and Ticket info
 */
class ListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('feature:list')
            ->setDescription('list all branches with matching JIRA ticket info')
            ->setHelp('This command lists all branches (git branch -r) with matching JIRA ticket info')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $config = new AppConfig();
        
        $clf = new CommandLineFormatter();
        

        $io = new SymfonyStyle($input, $output);

        $releaseBranchCollection = new GitReleaseBranchCollection($config);
        $releaseBranchCollectionItems = $releaseBranchCollection->getItems();
        $latestReleaseBranch = array_pop($releaseBranchCollectionItems);
        $latestReleaseBranchName = $latestReleaseBranch->getData()->name();
        $projects = $config->get('jira', 'projects');
        $io->title(
            sprintf(
                'Building Release: %s for projects: %s',
                $clf->format($latestReleaseBranchName, 'green'),
                $clf->format($projects, 'green')
            )
        );

        $branchCollection = new GitProjectBranchCollection($config);
        foreach ($branchCollection->getItems() as $branch) {
            $branchData = $branch->getData();
            $ticket = new JiraTicket($branchData->ticket(), $config);
            $ticketData = $ticket->getData();
            $ticketKey = $ticketData->key();
            $ticketStatus = $ticketData->status();
            $branchName = $branchData->name();
            $devMergedStatus = $branch->isMergedTo($config->get('git', 'test_branch'));
            $releaseMergedStatus = $branch->isMergedTo($latestReleaseBranchName);
            $masterMergedStatus = $branch->isMergedTo($config->get('git', 'master_branch'));

            $io->text(
                sprintf(
                    '%-10s  %s%s%s  %-30s %s',
                    $ticketKey,
                    $devMergedStatus ? $clf->format(' d ', 'blue') : ' - ',
                    $releaseMergedStatus ? $clf->format(' r ', 'green') : ' - ',
                    $masterMergedStatus ? $clf->format(' m ', 'white', 'green') : ' - ',
                    '['.$ticketStatus.']',
                    $clf->format($branchName, 'yellow')
                )
            );
        }
    }
}