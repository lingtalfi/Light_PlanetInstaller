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


        $lightOnly = $input->hasFlag("l");


        $n = 0;
        $universeDir = $this->application->getUniversePath();
        $planetDirs = PlanetTool::getPlanetDirs($universeDir);
        foreach ($planetDirs as $planetDir) {
            list($galaxy, $planet) = PlanetTool::getGalaxyNamePlanetNameByDir($planetDir);

            if (true === $lightOnly && false === str_starts_with($planet, "Light_")) {
                continue;
            }


            $n++;

            $version = MetaInfoTool::getVersion($planetDir);
            $output->write("$galaxy.$planet: $version" . PHP_EOL);
        }


        $output->write("$n elements displayed." . PHP_EOL);

    }


    /**
     * @overrides
     */
    public function getDescription(): string
    {
        return "Lists all the planets found in the current application, along with their current version numbers.";
    }


    /**
     * @overrides
     */
    public function getFlags(): array
    {
        return [
            "l" => "display only light planets",
        ];
    }


}