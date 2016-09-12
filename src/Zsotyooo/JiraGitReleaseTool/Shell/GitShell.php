<?php

namespace Zsotyooo\JiraGitReleaseTool\Shell;

use Zsotyooo\JiraGitReleaseTool\Config\Config as AppConfig;

/**
 * Git shell
 */
class GitShell
{
    private $config;
    
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * execute git command
     * 
     * @param  string $command
     * @return mixed
     */
    public function exec($command)
    {
        exec(
            sprintf('cd %s', $this->config->get('git', 'project_folder')) . ' && ' . $command,
            $output
        );
        return $output;
    }
}