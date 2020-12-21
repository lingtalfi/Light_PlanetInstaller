<?php


namespace Ling\Light_PlanetInstaller\CliTools\Command;


use Ling\CliTools\Input\InputInterface;
use Ling\CliTools\Output\OutputInterface;
use Ling\UniverseTools\MetaInfoTool;
use Ling\UniverseTools\PlanetTool;


/**
 * The ListCommand class.
 *
 */
class ListCommand extends LightPlanetInstallerBaseCommand
{


    /**
     * @implementation
     */
    protected function doRun(InputInterface $input, OutputInterface $output)
    {

        $universeDir = $this->getUniversePath();
        $planetDirs = PlanetTool::getPlanetDirs($universeDir);
        foreach ($planetDirs as $planetDir) {
            list($galaxy, $planet) = PlanetTool::getGalaxyNamePlanetNameByDir($planetDir);
            $version = MetaInfoTool::getVersion($planetDir);
            $output->write("$galaxy.$planet: $version" . PHP_EOL);
        }

    }
}