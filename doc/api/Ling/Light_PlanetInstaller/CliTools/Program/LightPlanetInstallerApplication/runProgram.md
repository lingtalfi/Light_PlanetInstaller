[Back to the Ling/Light_PlanetInstaller api](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller.md)<br>
[Back to the Ling\Light_PlanetInstaller\CliTools\Program\LightPlanetInstallerApplication class](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Program/LightPlanetInstallerApplication.md)


LightPlanetInstallerApplication::runProgram
================



LightPlanetInstallerApplication::runProgram — Runs the program, and returns the exit status.




Description
================


protected [LightPlanetInstallerApplication::runProgram](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Program/LightPlanetInstallerApplication/runProgram.md)(Ling\CliTools\Input\InputInterface $input, [Ling\CliTools\Output\OutputInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Output/OutputInterface.md) $output) : int | null




Runs the program, and returns the exit status.

Note: This method was written with the intent to be overridden by the user (i.e you should override this method in a sub-class).



Parameters
================


- input

    

- output

    


Return values
================

Returns int | null.
The exit status.
If null is returned, 0 should be assumed.







Source Code
===========
See the source code for method [LightPlanetInstallerApplication::runProgram](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/CliTools/Program/LightPlanetInstallerApplication.php#L120-L126)


See Also
================

The [LightPlanetInstallerApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Program/LightPlanetInstallerApplication.md) class.

Previous method: [__construct](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Program/LightPlanetInstallerApplication/__construct.md)<br>Next method: [getBashtmlFormat](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/CliTools/Program/LightPlanetInstallerApplication/getBashtmlFormat.md)<br>

