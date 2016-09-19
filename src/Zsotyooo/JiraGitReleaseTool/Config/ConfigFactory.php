<?php
namespace Zsotyooo\JiraGitReleaseTool\Config;

use Zsotyooo\JiraGitReleaseTool\Config\Loader as ConfigLoader;

/**
 * Config
 */
class ConfigFactory
{
    static public $_instance;

    private $loader;

    public function __construct(ConfigLoader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * get config
     * 
     * @param  ConfigLoader $loader
     * @return Config
     */
    public function createConfig()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config($this->loader);
        }
        return self::$_instance;
    }
}