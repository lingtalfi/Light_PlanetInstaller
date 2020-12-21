<?php


namespace Ling\Light_PlanetInstaller\CliTools\Command;


use Ling\Bat\ConsoleTool;
use Ling\CliTools\Input\InputInterface;
use Ling\CliTools\Output\OutputInterface;
use Ling\Light_PlanetInstaller\Helper\LpiConfHelper;


/**
 * The OpenDirCommand class.
 *
 */
class OpenDirCommand extends LightPlanetInstallerBaseCommand
{


    /**
     * @implementation
     */
    protected function doRun(InputInterface $input, OutputInterface $output)
    {


        $globalDir = LpiConfHelper::getGlobalDirPath();
        ConsoleTool::exec('open "' . str_replace('"', '\"', $globalDir) . '"');

    }
}