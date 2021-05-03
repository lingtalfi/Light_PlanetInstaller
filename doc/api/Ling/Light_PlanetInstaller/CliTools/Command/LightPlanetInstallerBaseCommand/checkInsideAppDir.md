[Back to the Ling/Light_PlanetInstaller api](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller.md)<br>
[Back to the Ling\Light_PlanetInstaller\CliTools\Command\LightPlanetInstallerBaseCommand class](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand.md)


LightPlanetInstallerBaseCommand::checkInsideAppDir
================



LightPlanetInstallerBaseCommand::checkInsideAppDir — Returns whether the current dir is correct universe application (i.e.




Description
================


protected [LightPlanetInstallerBaseCommand::checkInsideAppDir](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/checkInsideAppDir.md)([Ling\CliTools\Output\OutputInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Output/OutputInterface.md) $output) : bool




Returns whether the current dir is correct universe application (i.e. containing an universe dir).

It will also try to inject the minimum setup for a working universe (if it's not there already), which is:

- the bigbang.php script
- the BumbleBee planet (autoloader class used by the bigbang script)




Parameters
================


- output

    


Return values
================

Returns bool.








Source Code
===========
See the source code for method [LightPlanetInstallerBaseCommand::checkInsideAppDir](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/CliTools/Command/LightPlanetInstallerBaseCommand.php#L177-L200)


See Also
================

The [LightPlanetInstallerBaseCommand](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand.md) class.

Previous method: [logError](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Command/LightPlanetInstallerBaseCommand/logError.md)<br>

