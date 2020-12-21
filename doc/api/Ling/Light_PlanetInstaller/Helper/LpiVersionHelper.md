[Back to the Ling/Light_PlanetInstaller api](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller.md)



The LpiVersionHelper class
================
2020-12-08 --> 2020-12-21






Introduction
============

The LpiVersionHelper class.



Class synopsis
==============


class <span class="pl-k">LpiVersionHelper</span>  {

- Methods
    - public static [versionMatchesVersionExpression](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Helper/LpiVersionHelper/versionMatchesVersionExpression.md)(string $planetDot, string $version, string $versionExpr, [Ling\Light_PlanetInstaller\Repository\LpiRepositoryInterface](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Repository/LpiRepositoryInterface.md) $repository) : bool
    - public static [compare](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Helper/LpiVersionHelper/compare.md)(string $realVersion1, string $realVersion2, ?bool $orEqual = false) : bool
    - public static [getFirstMatchingVersionByRepository](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Helper/LpiVersionHelper/getFirstMatchingVersionByRepository.md)(string $planetDot, $versionExpr, [Ling\Light_PlanetInstaller\Repository\LpiRepositoryInterface](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Repository/LpiRepositoryInterface.md) $repository) : false | string
    - public static [isPlus](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Helper/LpiVersionHelper/isPlus.md)(string $versionExpr) : bool
    - public static [removePlus](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Helper/LpiVersionHelper/removePlus.md)(string $versionExpr) : string

}






Methods
==============

- [LpiVersionHelper::versionMatchesVersionExpression](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Helper/LpiVersionHelper/versionMatchesVersionExpression.md) &ndash; Returns whether $version fits the $versionExpr for the given repository.
- [LpiVersionHelper::compare](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Helper/LpiVersionHelper/compare.md) &ndash; Returns whether version is strictly greater than version 2.
- [LpiVersionHelper::getFirstMatchingVersionByRepository](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Helper/LpiVersionHelper/getFirstMatchingVersionByRepository.md) &ndash; Returns the first real version number of the planet that matches $versionExpr, or false if not possible.
- [LpiVersionHelper::isPlus](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Helper/LpiVersionHelper/isPlus.md) &ndash; Returns whether the given versionExpression ends with the plus symbol.
- [LpiVersionHelper::removePlus](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Helper/LpiVersionHelper/removePlus.md) &ndash; Removes the trailing plus symbol from the given version expression and returns the result.





Location
=============
Ling\Light_PlanetInstaller\Helper\LpiVersionHelper<br>
See the source code of [Ling\Light_PlanetInstaller\Helper\LpiVersionHelper](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/Helper/LpiVersionHelper.php)



SeeAlso
==============
Previous class: [LpiImporterHelper](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Helper/LpiImporterHelper.md)<br>Next class: [LpiWebHelper](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Helper/LpiWebHelper.md)<br>
