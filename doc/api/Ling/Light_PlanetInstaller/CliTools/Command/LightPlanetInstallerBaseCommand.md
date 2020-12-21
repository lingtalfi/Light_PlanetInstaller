[Back to the Ling/Light_PlanetInstaller api](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller.md)



The LightPlanetInstallerBaseCommand class
================
2020-12-08 --> 2020-12-21






Introduction
============

The LightPlanetInstallerBaseCommand class.



Class synopsis
==============


abstract class <span class="pl-k">LightPlanetInstallerBaseCommand</span> implements [CommandInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Command/CommandInterface.md) {

- Properties
    - protected [Ling\Light_PlanetInstaller\CliTools\Program\LightPlanetInstallerApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Program/LightPlanetInstallerApplication.md) [$application](#property-application) ;

- Methods
    - public [__construct](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/__construct.md)() : void
    - abstract protected [doRun](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/doRun.md)(Ling\CliTools\Input\InputInterface $input, [Ling\CliTools\Output\OutputInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Output/OutputInterface.md) $output) : void
    - public [run](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/run.md)(Ling\CliTools\Input\InputInterface $input, [Ling\CliTools\Output\OutputInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Output/OutputInterface.md) $output) : int
    - public [setApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/setApplication.md)([Ling\Light_PlanetInstaller\CliTools\Program\LightPlanetInstallerApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Program/LightPlanetInstallerApplication.md) $application) : void
    - public [hasLpiFile](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/hasLpiFile.md)(?array $options = []) : bool
    - public [createLpiFile](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/createLpiFile.md)() : void
    - public [getLpiPath](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getLpiPath.md)() : void
    - public [getUniversePath](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getUniversePath.md)() : void
    - public [updateApplicationByLpiFile](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/updateApplicationByLpiFile.md)(array $options) : void
    - public [logError](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/logError.md)(string $error) : void
    - protected [getBashtmlFormat](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/getBashtmlFormat.md)(string $type) : string

}




Properties
=============

- <span id="property-application"><b>application</b></span>

    This property holds the KaosApplication instance.
    
    



Methods
==============

- [LightPlanetInstallerBaseCommand::__construct](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/__construct.md) &ndash; Builds the LightPlanetInstallerBaseCommand instance.
- [LightPlanetInstallerBaseCommand::doRun](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/doRun.md) &ndash; Runs the command.
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
Ling\Light_PlanetInstaller\CliTools\Command\LightPlanetInstallerBaseCommand<br>
See the source code of [Ling\Light_PlanetInstaller\CliTools\Command\LightPlanetInstallerBaseCommand](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/CliTools/Command/LightPlanetInstallerBaseCommand.php)



SeeAlso
==============
Previous class: [InitCommand](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/InitCommand.md)<br>Next class: [ListCommand](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/ListCommand.md)<br>
