<?php


namespace Ling\Light_PlanetInstaller\CliTools\Command;


use Ling\Bat\ConsoleTool;
use Ling\CliTools\Input\InputInterface;
use Ling\CliTools\Output\OutputInterface;


/**
 * The HelpCommand class.
 * This command will display the help to the user.
 *
 *
 *
 */
class HelpCommand extends LightPlanetInstallerBaseCommand
{


    /**
     * @implementation
     */
    protected function doRun(InputInterface $input, OutputInterface $output)
    {


        ConsoleTool::reset();

        $format = 'white:bgBlue';


        $help = $this->n('help');
        $import = $this->n('import');
        $initCommand = $this->n('init');
        $dirCommand = $this->n('dir');
        $confCommand = $this->n('conf');
        $masterCommand = $this->n('master');
        $listCommand = $this->n('list');
        $planetIdArg = $this->arg('<planetId>');
        $versionExpressionArg = $this->arg('<versionExpression>');
        $optG = $this->opt('-g');
        $i4 = str_repeat(' ', 4);


        $output->write("<$format>" . str_repeat('=', 35) . "</$format>" . PHP_EOL);
        $output->write("<$format>*    Light Planet Installer        </$format>" . PHP_EOL);
        $output->write("<$format>" . str_repeat('=', 35) . "</$format>" . PHP_EOL);
        $output->write(PHP_EOL);
        $output->write("For more information see our conception notes: https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/pages/conception-notes.md" . PHP_EOL);


//        $output->write(PHP_EOL);
//        $output->write("<bold>Global options</bold>:" . PHP_EOL);
//        $output->write(str_repeat('-', 17) . PHP_EOL);
//        $output->write("The following options apply to all the commands." . PHP_EOL);
//        $output->write(PHP_EOL);
//        $output->write(H::j(1) . $this->o("indent=\$number") . ": sets the base indentation level used by most commands." . PHP_EOL);


        $output->write(PHP_EOL);
        $output->write("<bold>Commands list</bold>:" . PHP_EOL);
        $output->write(str_repeat('-', 17) . PHP_EOL);
        $output->write(PHP_EOL);


        $output->write("- $help: displays this help message." . PHP_EOL);
        $output->write("- $import: reads the <b>lpi.byml</b> file and imports/re-imports the plugins listed in it, if their version number has changed.
        Note: it will not remove any plugin that's not listed in the file." . PHP_EOL .
            "Note2: the plugins will be imported in the current app, and in the global directory if they aren't there yet." . PHP_EOL
        );
        $output->write("- $import $planetIdArg(:$versionExpressionArg)?: imports the planet identified by the given planetId and optional versionExpression." . PHP_EOL);
        $output->write($i4 . "Options: " . PHP_EOL);
        $output->write($i4 . "$optG: global, to import in the global directory rather than in the current app." . PHP_EOL);
        $output->write("- $initCommand: Creates the <b>lpi.byml</b> file, if it doesn't exist, at the root of the application." . PHP_EOL);
        $output->write("- $dirCommand: opens the global directory, using the macos <b>open</b> command" . PHP_EOL);
        $output->write("- $confCommand: opens the global conf file, using the macos <b>open</b> command" . PHP_EOL);
        $output->write("- $masterCommand: opens the lpi master file, using the macos <b>open</b> command" . PHP_EOL);
        $output->write("- $listCommand: lists the planets imported in the current application, along with their version numbers" . PHP_EOL);
    }



    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Returns a formatted command name string.
     *
     * @param string $commandName
     * @return string
     */
    private function n(string $commandName): string
    {
        return '<bold:red>' . $commandName . '</bold:red>';
    }

    /**
     * Returns a formatted option/parameter string.
     *
     * @param string $option
     * @return string
     */
    private function opt(string $option): string
    {
        return '<bold:bgLightYellow>' . $option . '</bold:bgLightYellow>';
    }

    /**
     * Returns a formatted configuration directive string.
     *
     * @param string $option
     * @return string
     */
    private function arg(string $option): string
    {
        return '<bold:blue>' . $option . '</bold:blue>';
    }
}