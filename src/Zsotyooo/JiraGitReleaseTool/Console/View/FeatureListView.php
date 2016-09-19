<?php
namespace Zsotyooo\JiraGitReleaseTool\Console\View;

class FeatureListView extends AbstractView
{
    public function render()
    {
        $config = $this->config;
        
        $data = $this->data();

        $this->io()->title(
            sprintf(
                'Building Release: %s for projects: %s',
                $this->clf()->format($data['latest_release_branch'], 'green'),
                $this->clf()->format($data['projects'], 'green')
            )
        );

        foreach ($data['branches'] as $branchData) {
            $this->_renderLine($branchData);
        }

    }

    private function _renderLine($data)
    {
        $this->io()->text(
            sprintf(
                '%-10s  %s%s%s  %-30s %s',
                $data['ticket_key'],
                $data['merged_dev'] ? $this->clf()->format(' d ', 'blue') : ' - ',
                $data['merged_release'] ? $this->clf()->format(' r ', 'green') : ' - ',
                $data['merged_master'] ? $this->clf()->format(' m ', 'white', 'green') : ' - ',
                '['.$data['ticket_status'].']',
                $this->clf()->format($data['branch_name'], 'yellow')
            )
        );
    }
}