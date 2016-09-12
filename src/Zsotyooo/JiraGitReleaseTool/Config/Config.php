<?php
namespace Zsotyooo\JiraGitReleaseTool\Config;

use Zsotyooo\JiraGitReleaseTool\Config\Loader as ConfigLoader;

/**
 * Config
 */
class Config
{
    private $defaultData = [
        'jira' => [
            'basic_auth' => '',
            'base_url' => '',
            'ticket_fetch_url' => '/rest/api/2/issue/%s',
            'projects' => ''
        ],
        'git' => [
            'project_folder' => '~',
            'test_branch' => 'origin/develop',
            'master_branch' => 'origin/master',
            'release_branch_prefix' => 'origin/release/'
        ]

    ];

    private $data = [];

    public function __construct()
    {
        $loader = new ConfigLoader();

        $data = $loader->config();

        $this->merge($data);
    }

    /**
     * merge config array
     * 
     * @param  array $data
     * @return $this
     */
    public function merge($data)
    {
        $this->data = array_replace_recursive([], $this->defaultData, $this->data, $data);
        return $this;
    }

    /**
     * get all config values
     * 
     * @return array
     */
    public function configData()
    {
        return $this->data;
    }

    /**
     * get config value
     * 
     * @param  string $namespace
     * @param  string $key
     * @return mixed
     */
    public function get($namespace, $key)
    {
        $data = $this->configData();
        return $data[$namespace][$key];
    }
}