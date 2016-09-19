<?php
namespace Zsotyooo\JiraGitReleaseTool\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Zsotyooo\JiraGitReleaseTool\Config\Config;
use Zsotyooo\JiraGitReleaseTool\App\ResultProvider as ResultProviderInterface;

/**
 * Command abstract
 */
abstract class AbstractCommand
    extends Command
{
    /**
     * Controller Model
     * 
     * @var ResultProviderInterface
     */
    protected $controller;

    /**
     * config
     * 
     * @var Config
     */
    protected $config;

    /**
     * Command name
     * 
     * @var string
     */
    protected $name = 'Unnamed';
    
    /**
     * @throws LogicException When the command name is empty
     */
    public function __construct($config, $view, $controller)
    {
        $this->config = $config;
        $this->view = $view;
        $this->controller = $controller;
        parent::__construct($this->name);
    }

    /**
     * get controller
     * 
     * @return ResultProviderInterface
     */
    public function controller()
    {
        return $this->controller;
    }

    /**
     * get config
     * 
     * @return Config
     */
    public function config()
    {
        return $this->config;
    }

    public function view()
    {
        return $this->view;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->view()->setInput($input);
        $this->view()->setOutput($output);
        $this->view()->setData(
            $this->controller()->getResult()->data()
        );
        $this->view()->render();
    }
}