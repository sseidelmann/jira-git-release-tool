<?php

namespace Zsotyooo\JiraGitReleaseTool\Config;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\FileLocator;

/**
 * Load config file
 */
class Loader
{
    const CONFIG_PATH = '../../../../config.yaml';

    private $config;

    public function __construct()
    {
        $configFileLocator = new FileLocator();
        $this->config = Yaml::parse(
                $configFileLocator->locate($this->configFilePath())
            );
    }

    /**
     * get config file path
     * 
     * @return string
     */
    protected function configFilePath()
    {
        return __DIR__ . '/' . self::CONFIG_PATH;
    }

    /**
     * get config object
     * 
     * @return Zsotyooo\JiraGitReleaseTool\Config\Config
     */
    public function config()
    {
        return $this->config;
    }
}