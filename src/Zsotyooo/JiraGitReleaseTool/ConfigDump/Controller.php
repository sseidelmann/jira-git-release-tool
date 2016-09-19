<?php

namespace Zsotyooo\JiraGitReleaseTool\ConfigDump;

use Zsotyooo\JiraGitReleaseTool\App\ResultProvider as ResultProviderInterface;
use Zsotyooo\JiraGitReleaseTool\App\Controller\Result;
use Zsotyooo\JiraGitReleaseTool\Config\Config;

/**
 * Config dump controller
 */
class Controller
    implements ResultProviderInterface
{
    /**
     * config
     * 
     * @var Config
     */
    private $config;

    public function __construct(
        $config
    )
    {
        $this->config = $config;
    }

    /**
     * get result
     * 
     * @return Result
     */
    public function getResult()
    {
        return new Result(
            $this->config->data()
        );
    }
}