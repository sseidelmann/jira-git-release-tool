<?php
namespace Zsotyooo\JiraGitReleaseTool\Console\View;

class ConfigDumpView 
    extends AbstractView
    implements View
{
    public function render()
    {
        var_dump($this->data());
    }
}