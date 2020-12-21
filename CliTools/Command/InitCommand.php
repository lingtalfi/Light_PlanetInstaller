<?php


namespace Ling\Light_PlanetInstaller\CliTools\Command;


use Ling\CliTools\Input\InputInterface;
use Ling\CliTools\Output\OutputInterface;


/**
 * The InitCommand class.
 *
 */
class InitCommand extends LightPlanetInstallerBaseCommand
{


    /**
     * @implementation
     */
    protected function doRun(InputInterface $input, OutputInterface $output)
    {

        $f1 = $this->getBashtmlFormat("file");
        $f2 = $this->getBashtmlFormat("file");

        if (true === $this->hasLpiFile()) {
            $output->write("The <$f1>lpi.byml</$f1> file was found, nothing to do :)" . PHP_EOL);
        } else {

            $lpiPath = $this->getLpiPath();
            $output->write("Creating the <$f1>lpi.byml</$f1> file at <$f2>$lpiPath</$f2>...");
            $this->createLpiFile();
            $output->write('...<success>ok</success>');
            $output->write(PHP_EOL);
        }
    }


}