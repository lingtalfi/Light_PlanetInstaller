Light_PlanetInstaller
===========
2020-12-08 -> 2020-12-21



Work in progress, don't use yet...



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

- 0.0.1 -- 2020-12-08

    - initial commit