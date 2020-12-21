<?php


namespace Ling\Light_PlanetInstaller\CliTools\Command;


use Ling\Bat\ConsoleTool;
use Ling\CliTools\Input\InputInterface;
use Ling\CliTools\Output\OutputInterface;
use Ling\Light_PlanetInstaller\Helper\LpiConfHelper;


/**
 * The OpenMasterCommand class.
 *
 */
class OpenMasterCommand extends LightPlanetInstallerBaseCommand
{


    /**
     * @implementation
     */
    protected function doRun(InputInterface $input, OutputInterface $output)
    {

        $path = LpiConfHelper::getMasterFilePath();
        ConsoleTool::exec('open "' . str_replace('"', '\"', $path) . '"');

    }
}