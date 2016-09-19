<?php

namespace Zsotyooo\JiraGitReleaseTool\Console;

use Symfony\Component\Console\Application as BaseApp;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Zsotyooo\JiraGitReleaseTool\App\DependencyInjection\ContainerBuilder;
use Zsotyooo\JiraGitReleaseTool\Console\Command\ListCommand;
use Zsotyooo\JiraGitReleaseTool\Console\Command\ConfigDumpCommand;

/**
 * Application
 */
class Application extends BaseApp
{

    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * get Default Commands
     * 
     * @return array
     */
    protected function getDefaultCommands()
    {
        $commands = parent::getDefaultCommands();
        
        $commands[] = $this->container()->get('app.console.command.featurelist');
        $commands[] = $this->container()->get('app.console.command.etcfeaturelist');
        $commands[] = $this->container()->get('app.console.command.configdump');

        return $commands;
    }

    /**
     * @return ContainerBuilder
     */
    public function container()
    {
        if (!isset($this->container)) {
            $this->container = new ContainerBuilder();
        }
        return $this->container;
    }
}