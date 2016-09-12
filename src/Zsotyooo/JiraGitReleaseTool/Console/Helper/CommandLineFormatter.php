<?php

namespace Zsotyooo\JiraGitReleaseTool\Console\Helper;

/**
 * Format command line text
 */
class CommandLineFormatter
{
    private $foreground_colors = array();
    private $background_colors = array();

    public function __construct()
    {
        // Set up shell colors
        $this->foreground_colors['black'] = '30';
        $this->foreground_colors['dark_gray'] = '30';
        $this->foreground_colors['blue'] = '34';
        $this->foreground_colors['light_blue'] = '34';
        $this->foreground_colors['green'] = '32';
        $this->foreground_colors['light_green'] = '32';
        $this->foreground_colors['cyan'] = '36';
        $this->foreground_colors['light_cyan'] = '36';
        $this->foreground_colors['red'] = '31';
        $this->foreground_colors['light_red'] = '31';
        $this->foreground_colors['purple'] = '35';
        $this->foreground_colors['light_purple'] = '35';
        $this->foreground_colors['brown'] = '33';
        $this->foreground_colors['yellow'] = '33';
        $this->foreground_colors['light_gray'] = '37';
        $this->foreground_colors['white'] = '37';

        $this->background_colors['black'] = '40';
        $this->background_colors['red'] = '41';
        $this->background_colors['green'] = '42';
        $this->background_colors['yellow'] = '43';
        $this->background_colors['blue'] = '44';
        $this->background_colors['magenta'] = '45';
        $this->background_colors['cyan'] = '46';
        $this->background_colors['light_gray'] = '47';
    }

    /**
     * format text
     * 
     * @param  string $string
     * @param  string $foregroundColor
     * @param  string $backgroundColor
     * @return string
     */
    public function format($string, $foregroundColor = null, $backgroundColor = null)
    {
        $coloredString = "";

        if (isset($this->foreground_colors[$foregroundColor])) {
            $coloredString .= "\033[" . $this->foreground_colors[$foregroundColor] . "m";
        }

        if (isset($this->background_colors[$backgroundColor])) {
            $coloredString .= "\033[" . $this->background_colors[$backgroundColor] . "m";
        }

        $coloredString .=  $string . "\033[0m";

        return $coloredString;
    }
}