<?php
namespace Zsotyooo\JiraGitReleaseTool\Console\View;

use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zsotyooo\JiraGitReleaseTool\Console\Helper\CommandLineFormatter;
use Symfony\Component\Console\Style\SymfonyStyle;
use Zsotyooo\JiraGitReleaseTool\Config\Config;

abstract class AbstractView
{
    protected $input;

    protected $output;

    protected $config;

    protected $data;

    protected $io;

    protected $clf;
    
    /**
     * @param Config $config
     */
    public function __construct(
        $config
    )
    {
        $this->config = $config;
    }

    /**
     * io
     * 
     * @return SymfonyStyle
     */
    public function io()
    {
        if (is_null($this->io)) {
            $this->io = new SymfonyStyle($this->input(), $this->output());
        }
        return $this->io;
    }

    /**
     * command line formatter
     * 
     * @return CommandLineFormatter
     */
    public function clf()
    {
        if (is_null($this->clf)) {
            $this->clf = new CommandLineFormatter();
        }
        return $this->clf;
    }

    /**
     * set input
     * 
     * @param InputInterface $input
     */
    public function setInput($input)
    {
        $this->input = $input;
    }

    /**
     * get input
     * 
     * @return InputInterface
     */
    public function input()
    {
        return $this->input;
    }

    /**
     * set output
     * 
     * @param OutputInterface $output
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }

    /**
     * get output
     * 
     * @return OutputInterface
     */
    public function output()
    {
        return $this->output;
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

    /**
     * set data
     * 
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * get data
     * 
     * @return mixed
     */
    public function data()
    {
        return $this->data;
    }
}