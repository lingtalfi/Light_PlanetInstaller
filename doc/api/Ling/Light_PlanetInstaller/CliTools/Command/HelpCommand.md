[Back to the Ling/Light_PlanetInstaller api](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller.md)



The HelpCommand class
================
2020-12-08 --> 2020-12-21






Introduction
============

The HelpCommand class.
This command will display the help to the user.



Class synopsis
==============


class <span class="pl-k">HelpCommand</span> extends [LightPlanetInstallerBaseCommand](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand.md) implements [CommandInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Command/CommandInterface.md) {

- Inherited properties
    - protected [Ling\Light_PlanetInstaller\CliTools\Program\LightPlanetInstallerApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Program/LightPlanetInstallerApplication.md) [LightPlanetInstallerBaseCommand::$application](#property-application) ;

- Methods
    - protected [doRun](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/HelpCommand/doRun.md)(Ling\CliTools\Input\InputInterface $input, [Ling\CliTools\Output\OutputInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Output/OutputInterface.md) $output) : void
    - private [n](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/HelpCommand/n.md)(string $commandName) : string
    - private [opt](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/HelpCommand/opt.md)(string $option) : string
    - private [arg](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/HelpCommand/arg.md)(string $option) : string

- Inherited methods
    - public [LightPlanetInstallerBaseCommand::__construct](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/__construct.md)() : void
    - public [LightPlanetInstallerBaseCommand::run](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/run.md)(Ling\CliTools\Input\InputInterface $input, [Ling\CliTools\Output\OutputInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Output/OutputInterface.md) $output) : int
    - public [LightPlanetInstallerBaseCommand::setApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/setApplication.md)([Ling\Light_PlanetInstaller\CliTools\Program\LightPlanetInstallerApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Program/LightPlanetInstallerApplication.md) $application) : void
    - public [LightPlanetInstallerBaseCommand::hasLpiFile](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/hasLpiFile.md)(?array $options = []) : bool
    - public [LightPlanetInstallerBaseCommand::createLpiFile](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/createLpiFile.md)() : void
    - public [LightPlanetInstallerBaseCommand::getLpiPath](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getLpiPath.md)() : void
    - public [LightPlanetInstallerBaseCommand::getUniversePath](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getUniversePath.md)() : void
    - public [LightPlanetInstallerBaseCommand::updateApplicationByLpiFile](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/updateApplicationByLpiFile.md)(array $options) : void
    - public [LightPlanetInstallerBaseCommand::logError](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/logError.md)(string $error) : void
    - protected [LightPlanetInstallerBaseCommand::getBashtmlFormat](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getBashtmlFormat.md)(string $type) : string

}






Methods
==============

- [HelpCommand::doRun](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/HelpCommand/doRun.md) &ndash; Runs the command.
- [HelpCommand::n](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/HelpCommand/n.md) &ndash; Returns a formatted command name string.
- [HelpCommand::opt](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/HelpCommand/opt.md) &ndash; Returns a formatted option/parameter string.
- [HelpCommand::arg](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/HelpCommand/arg.md) &ndash; Returns a formatted configuration directive string.
- [LightPlanetInstallerBaseCommand::__construct](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/__construct.md) &ndash; Builds the LightPlanetInstallerBaseCommand instance.
- [LightPlanetInstallerBaseCommand::run](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/run.md) &ndash; Runs the command.
- [LightPlanetInstallerBaseCommand::setApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/setApplication.md) &ndash; Sets the application.
- [LightPlanetInstallerBaseCommand::hasLpiFile](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/hasLpiFile.md) &ndash; Proxy to the application's hasLpiFile method.
- [LightPlanetInstallerBaseCommand::createLpiFile](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/createLpiFile.md) &ndash; Proxy to the application's createLpiFile method.
- [LightPlanetInstallerBaseCommand::getLpiPath](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getLpiPath.md) &ndash; Proxy to the application's getLpiPath method.
- [LightPlanetInstallerBaseCommand::getUniversePath](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getUniversePath.md) &ndash; Proxy to the application's getUniversePath method.
- [LightPlanetInstallerBaseCommand::updateApplicationByLpiFile](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/updateApplicationByLpiFile.md) &ndash; Proxy to the application's updateApplicationByLpiFile method.
- [LightPlanetInstallerBaseCommand::logError](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/logError.md) &ndash; Proxy to the application's logError method.
- [LightPlanetInstallerBaseCommand::getBashtmlFormat](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getBashtmlFormat.md) &ndash; Proxy to the application's getBashtmlFormat method.





Location
=============
Ling\Light_PlanetInstaller\CliTools\Command\HelpCommand<br>
See the source code of [Ling\Light_PlanetInstaller\CliTools\Command\HelpCommand](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/CliTools/Command/HelpCommand.php)



SeeAlso
==============
Next class: [ImportCommand](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/ImportCommand.md)<br>
