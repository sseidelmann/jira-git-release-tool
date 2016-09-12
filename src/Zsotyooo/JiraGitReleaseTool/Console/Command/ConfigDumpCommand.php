<?php

namespace Zsotyooo\JiraGitReleaseTool\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zsotyooo\JiraGitReleaseTool\Config\Config as AppConfig;

/**
 * See what is in the config
 */
class ConfigDumpCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('config:show')
            ->setDescription('show config values')
            ->setHelp('Show config values')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = new AppConfig();
        var_dump($config->configData());
    }
}