<?php

namespace Zsotyooo\JiraGitReleaseTool\Console\Command;

/**
 * See what is in the config
 */
class ConfigDumpCommand extends AbstractCommand
{
    protected $name = "Config Show";

    
    protected function configure()
    {
        $this
            ->setName('config:show')
            ->setDescription('show config values')
            ->setHelp('Show config values')
        ;
    }
}