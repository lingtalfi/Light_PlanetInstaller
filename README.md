Light_PlanetInstaller
===========
2020-12-08 -> 2021-02-18



An installer plugin for planets in the universe.


This is a [Light plugin](https://github.com/lingtalfi/Light/blob/master/doc/pages/plugin.md).

This is part of the [universe framework](https://github.com/karayabin/universe-snapshot).


Install
==========
Using the [uni](https://github.com/lingtalfi/universe-naive-importer) command.
```bash
uni import Ling/Light_PlanetInstaller
```

Or just download it and place it where you want otherwise.






Summary
===========
- [Light_PlanetInstaller api](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller.md) (generated with [DocTools](https://github.com/lingtalfi/DocTools))
- [Services](#services)
- Pages
    - [Conception notes](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/pages/conception-notes.md)






Services
=========


Here is an example of the service configuration:

```yaml
planet_installer:
    instance: Ling\Light_PlanetInstaller\Service\LightPlanetInstallerService
    methods:
        setContainer:
            container: @container()
        setOptions:
            options: []







```



History Log
=============

- 1.0.7 -- 2021-02-18

    - add "deps" command
  
- 1.0.6 -- 2021-02-15

    - update list command, now also displays the number of elements displayed
  
- 1.0.5 -- 2021-02-15

    - update list command, add -l option to display only light plugins
  
- 1.0.4 -- 2021-02-11

    - update LogicInstallCommand, more verbose in debug mode
    - fix LpiHelper::createLpiDepsFileByPlanetDir calling removed ReadmeTool
  
- 1.0.3 -- 2021-02-05

    - add force flag to import/install commands
    - remove dependencies to Ling.LingTalfi planet
  
- 1.0.2 -- 2021-02-02

    - add concept of local universe
  
- 1.0.1 -- 2021-01-29

    - improve one of the "install" command output messages
  
- 1.0.0 -- 2021-01-26

    - first version
  
- 0.0.1 -- 2020-12-08

    - initial commit