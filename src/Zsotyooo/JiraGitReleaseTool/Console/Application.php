<?php

namespace Zsotyooo\JiraGitReleaseTool\Console;

use Symfony\Component\Console\Application as BaseApp;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zsotyooo\JiraGitReleaseTool\Console\Command\ListCommand;
use Zsotyooo\JiraGitReleaseTool\Console\Command\ConfigDumpCommand;

/**
 * Application
 */
class Application extends BaseApp
{
    protected function getDefaultCommands()
    {
        $commands = parent::getDefaultCommands();
        
        $commands[] = new ListCommand();
        $commands[] = new ConfigDumpCommand();

        return $commands;
    }
}