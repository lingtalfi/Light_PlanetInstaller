[Back to the Ling/Light_PlanetInstaller api](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller.md)



The ToDirCommand class
================
2020-12-08 --> 2021-03-05






Introduction
============

The ToDirCommand class.



Class synopsis
==============


class <span class="pl-k">ToDirCommand</span> extends [LightPlanetInstallerBaseCommand](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand.md) implements [LightServiceContainerAwareInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerAwareInterface.md), [LightCliCommandInterface](https://github.com/lingtalfi/Light_Cli/blob/master/doc/api/Ling/Light_Cli/CliTools/Program/LightCliCommandInterface.md), [CommandInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Command/CommandInterface.md) {

- Inherited properties
    - protected [Ling\Light_PlanetInstaller\CliTools\Program\LightPlanetInstallerApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Program/LightPlanetInstallerApplication.md) [LightPlanetInstallerBaseCommand::$application](#property-application) ;
    - protected [Ling\Light\ServiceContainer\LightServiceContainerInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md) [LightPlanetInstallerBaseCommand::$container](#property-container) ;

- Methods
    - protected [doRun](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/ToDirCommand/doRun.md)(Ling\CliTools\Input\InputInterface $input, [Ling\CliTools\Output\OutputInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Output/OutputInterface.md) $output) : void
    - public [getDescription](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/ToDirCommand/getDescription.md)() : string
    - public [getFlags](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/ToDirCommand/getFlags.md)() : array
    - public [getAliases](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/ToDirCommand/getAliases.md)() : array

- Inherited methods
    - public [LightPlanetInstallerBaseCommand::__construct](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/__construct.md)() : void
    - public [LightPlanetInstallerBaseCommand::setContainer](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/setContainer.md)([Ling\Light\ServiceContainer\LightServiceContainerInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md) $container) : void
    - public [LightPlanetInstallerBaseCommand::run](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/run.md)(Ling\CliTools\Input\InputInterface $input, [Ling\CliTools\Output\OutputInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Output/OutputInterface.md) $output) : mixed
    - public [LightPlanetInstallerBaseCommand::getName](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getName.md)() : string
    - public [LightPlanetInstallerBaseCommand::getOptions](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getOptions.md)() : array
    - public [LightPlanetInstallerBaseCommand::getParameters](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getParameters.md)() : array
    - public [LightPlanetInstallerBaseCommand::setApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/setApplication.md)([Ling\Light_PlanetInstaller\CliTools\Program\LightPlanetInstallerApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Program/LightPlanetInstallerApplication.md) $application) : void
    - public [LightPlanetInstallerBaseCommand::logError](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/logError.md)(Exception|string $error) : void
    - protected [LightPlanetInstallerBaseCommand::checkInsideAppDir](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/checkInsideAppDir.md)([Ling\CliTools\Output\OutputInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Output/OutputInterface.md) $output) : bool

}






Methods
==============

- [ToDirCommand::doRun](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/ToDirCommand/doRun.md) &ndash; Runs the command.
- [ToDirCommand::getDescription](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/ToDirCommand/getDescription.md) &ndash; Returns the description of the command.
- [ToDirCommand::getFlags](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/ToDirCommand/getFlags.md) &ndash; Returns the array of flags available for this command, which form is name => description.
- [ToDirCommand::getAliases](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/ToDirCommand/getAliases.md) &ndash; Returns the aliases used by this command.
- [LightPlanetInstallerBaseCommand::__construct](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/__construct.md) &ndash; Builds the LightPlanetInstallerBaseCommand instance.
- [LightPlanetInstallerBaseCommand::setContainer](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/setContainer.md) &ndash; Sets the light service container interface.
- [LightPlanetInstallerBaseCommand::run](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/run.md) &ndash; Runs the command.
- [LightPlanetInstallerBaseCommand::getName](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getName.md) &ndash; Returns the name of the command.
- [LightPlanetInstallerBaseCommand::getOptions](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getOptions.md) &ndash; Returns the array of available options for this command, which form is name => optionItem.
- [LightPlanetInstallerBaseCommand::getParameters](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getParameters.md) &ndash; Returns the parameters available for this command.
- [LightPlanetInstallerBaseCommand::setApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/setApplication.md) &ndash; Sets the application.
- [LightPlanetInstallerBaseCommand::logError](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/logError.md) &ndash; Proxy to the application's logError method.
- [LightPlanetInstallerBaseCommand::checkInsideAppDir](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/checkInsideAppDir.md) &ndash; Returns whether the current dir is an application dir (containing an universe dir).





Location
=============
Ling\Light_PlanetInstaller\CliTools\Command\ToDirCommand<br>
See the source code of [Ling\Light_PlanetInstaller\CliTools\Command\ToDirCommand](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/CliTools/Command/ToDirCommand.php)



SeeAlso
==============
Previous class: [RemoveCommand](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/RemoveCommand.md)<br>Next class: [ToLinkCommand](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/ToLinkCommand.md)<br>
