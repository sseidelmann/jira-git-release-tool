<?php

namespace Zsotyooo\JiraGitReleaseTool\App\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder as BaseContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * DI Container
 */
class ContainerBuilder extends BaseContainerBuilder
{
    /**
     * DI files to load
     * 
     * @var array
     */
    private $diFiles = [
        '../../Config/config/di.xml',
        '../../Console/config/di.xml',
        '../../ConfigDump/config/di.xml',
        '../../Feature/config/di.xml',
        '../../Git/config/di.xml',
        '../../Jira/config/di.xml',
        '../../JiraRestApi/config/di.xml',
    ];

    /**
     * @param ParameterBagInterface $parameterBag A ParameterBagInterface instance
     */
    public function __construct(ParameterBagInterface $parameterBag = null)
    {
        parent::__construct($parameterBag);

        $loader = new XmlFileLoader($this, new FileLocator());
        foreach ($this->diFiles as $fileName) {
            $loader->load(__DIR__ . '/' . $fileName);
        }
    }
}