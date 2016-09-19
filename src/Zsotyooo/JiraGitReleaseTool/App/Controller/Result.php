<?php

namespace Zsotyooo\JiraGitReleaseTool\App\Controller;

use Zsotyooo\JiraGitReleaseTool\App\DataProvider as DataProviderInterface;

/**
 * Controller result
 */
class Result
    implements DataProviderInterface
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param mixed $data
     */
    public function __construct($data)
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