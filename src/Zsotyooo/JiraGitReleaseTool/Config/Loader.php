<?php

namespace Zsotyooo\JiraGitReleaseTool\Config;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\FileLocator;
use Zsotyooo\JiraGitReleaseTool\App\DataProvider as DataProviderInterface;

/**
 * Load config file
 */
class Loader
    implements DataProviderInterface
{
    const CONFIG_PATH = '../../../../config.yaml';

    /**
     * config values
     * 
     * @var array
     */
    private $data;

    public function __construct()
    {
        $configFileLocator = new FileLocator();
        $this->data = Yaml::parse(
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
     * get config array
     * 
     * @return array
     */
    public function data()
    {
        return $this->data;
    }
}