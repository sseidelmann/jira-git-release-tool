<?php

namespace Zsotyooo\JiraGitReleaseTool\Api\Jira;

use GuzzleHttp\Client as GuzzleClient;

/**
 * JIRA API Client
 */
class Client
{
    private $httpClient;

    private $config;
    
    public function __construct($config)
    {
        $this->config = $config;

        $this->httpClient  = new GuzzleClient(
            [
                'headers' => [
                    'Authorization' => 'Basic '.$this->config->get('jira', 'basic_auth')
                ]
            ]
        );
    }

    /**
     * make get request to JIRA API
     * @param  string $url
     * @param  array  $params
     * @return array
     */
    public function get($url, $params = [])
    {
        $url = $this->config->get('jira', 'base_url') . $url;
        return json_decode($this->httpClient->get($url, $params)->getBody()->getContents(), true);
    }
}