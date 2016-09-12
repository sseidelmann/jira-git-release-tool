<?php

namespace Zsotyooo\JiraGitReleaseTool\Jira;

/**
 * ticket data
 */
class TicketData
{
    private $key;

    private $summary;

    private $status;

    public function __construct($data)
    {
        $this->key = $data['key'];
        $this->summary = $data['fields']['summary'];
        $this->status = $data['fields']['status']['name'];
    }

    /**
     * get the key
     * 
     * @return string
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * get the summary
     * 
     * @return string
     */
    public function summary()
    {
        return $this->key;
    }

    /**
     * get the status
     * 
     * @return string
     */
    public function status()
    {
        return $this->status;
    }
}