<?php


namespace Ling\Light_PlanetInstaller\CliTools\Command;


use Ling\CliTools\Input\InputInterface;
use Ling\CliTools\Output\OutputInterface;


/**
 * The ImportCommand class.
 *
 */
class ImportCommand extends LightPlanetInstallerBaseCommand
{


    /**
     * @implementation
     */
    protected function doRun(InputInterface $input, OutputInterface $output)
    {

        $f1 = $this->getBashtmlFormat("file");
        $f2 = $this->getBashtmlFormat("command");
        $param1 = $input->getParameter(2);
        $appDir = $input->getOption("app") ?? null;


        //--------------------------------------------
        // NO PLANET SPECIFIED: READ THE LPI FILE
        //--------------------------------------------
        if (null === $param1) {

            if (true === $this->hasLpiFile([
                    'appDir' => $appDir,
                ])) {
                $this->updateApplicationByLpiFile([
                    'mode' => 'import',
                    'appDir' => $appDir,
                ]);

            } else {
                $output->write("No <$f1>lpi.byml</$f1> file found, use the <$f2>init</$f2> command to create one." . PHP_EOL);
            }

        }

        //--------------------------------------------
        // IMPORT A SPECIFIC PLANET
        //--------------------------------------------
        else {

            $output->write("todo: here...");
        }
    }


}