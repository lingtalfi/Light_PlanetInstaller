[Back to the Ling/Light_PlanetInstaller api](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller.md)



The PlanetImportProcessUtil class
================
2020-12-08 --> 2020-12-21






Introduction
============

The PlanetImportProcessUtil class.



Class synopsis
==============


class <span class="pl-k">PlanetImportProcessUtil</span>  {

- Properties
    - protected [Ling\Light\ServiceContainer\LightServiceContainerInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md) [$container](#property-container) ;
    - protected [Ling\CliTools\Output\OutputInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Output/OutputInterface.md) [$output](#property-output) ;
    - protected array [$problems](#property-problems) ;
    - private bool [$devMode](#property-devMode) ;
    - private array [$planetInstallList](#property-planetInstallList) ;
    - private string [$mainPlanet](#property-mainPlanet) ;
    - private string [$mainPlanetVersion](#property-mainPlanetVersion) ;
    - private int [$indent](#property-indent) ;
    - private string [$indentChars](#property-indentChars) ;
    - private bool [$forceMode](#property-forceMode) ;
    - private string [$applicationDir](#property-applicationDir) ;

- Methods
    - public [__construct](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/__construct.md)() : void
    - public [setContainer](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/setContainer.md)([Ling\Light\ServiceContainer\LightServiceContainerInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md) $container) : void
    - public [setOutput](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/setOutput.md)([Ling\CliTools\Output\OutputInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Output/OutputInterface.md) $output) : void
    - public [setDevMode](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/setDevMode.md)(bool $devMode) : void
    - public [setForceMode](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/setForceMode.md)(bool $forceMode) : void
    - public [importTo](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/importTo.md)(string $planetDot, string $versionExpr, string $applicationDir) : void
    - public [getProblems](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/getProblems.md)() : array
    - protected [log](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/log.md)(string $type, $msg) : void
    - protected [addProblem](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/addProblem.md)(string $code) : void
    - private [doImportItem](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/doImportItem.md)(string $planetDot, string $versionExpr, string $applicationDir) : int
    - private [getErrorMessageByException](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/getErrorMessageByException.md)([\Exception](http://php.net/manual/en/class.exception.php) $e) : string
    - private [addWarnings](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/addWarnings.md)(string $title, array $warnings) : void
    - private [moveTmpBuildToApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/moveTmpBuildToApplication.md)(string $tmpBuildDir, string $applicationDir) : void
    - private [error](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/error.md)(string $msg, ?int $code = null) : void

}




Properties
=============

- <span id="property-container"><b>container</b></span>

    This property holds the container for this instance.
    
    

- <span id="property-output"><b>output</b></span>

    This property holds the output for this instance.
    
    

- <span id="property-problems"><b>problems</b></span>

    This property holds the problems for this instance.
    
    

- <span id="property-devMode"><b>devMode</b></span>

    Whether to turn on the devMode.
    In dev mode:
    - show exception trace in error messages
    - don't delete the tmp build directory (so that the dev can inspect it)
    
    

- <span id="property-planetInstallList"><b>planetInstallList</b></span>

    This property holds the planetInstallList for this instance.
    It's an array of planetDotName => realVersion.
    It doesn't contain the main planet, which should be installed last is referred by the mainPlanet property below.
    
    

- <span id="property-mainPlanet"><b>mainPlanet</b></span>

    This property holds the mainPlanet for this instance.
    
    

- <span id="property-mainPlanetVersion"><b>mainPlanetVersion</b></span>

    This property holds the mainPlanetVersion for this instance.
    
    

- <span id="property-indent"><b>indent</b></span>

    The current indent level.
    
    

- <span id="property-indentChars"><b>indentChars</b></span>

    The indentChars used to indent log lines.
    
    

- <span id="property-forceMode"><b>forceMode</b></span>

    Whether to execute as much of the process as you can, even if it contains errors.
    Note that this might lead to non atomic/inconsistent installation.
    It's generally not recommended to use this mode, unless you're aware of what problems the non-forced installation
    has and you're ok with it.
    
    

- <span id="property-applicationDir"><b>applicationDir</b></span>

    This property holds the applicationDir for this instance.
    
    



Methods
==============

- [PlanetImportProcessUtil::__construct](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/__construct.md) &ndash; Builds the PlanetInstallerUtil instance.
- [PlanetImportProcessUtil::setContainer](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/setContainer.md) &ndash; Sets the container.
- [PlanetImportProcessUtil::setOutput](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/setOutput.md) &ndash; Sets the output.
- [PlanetImportProcessUtil::setDevMode](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/setDevMode.md) &ndash; Sets the devMode.
- [PlanetImportProcessUtil::setForceMode](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/setForceMode.md) &ndash; Sets the forceMode.
- [PlanetImportProcessUtil::importTo](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/importTo.md) &ndash; Imports the given planet and its dependencies recursively to the destination directory.
- [PlanetImportProcessUtil::getProblems](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/getProblems.md) &ndash; Returns the problems that occurred during this process.
- [PlanetImportProcessUtil::log](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/log.md) &ndash; Logs some message.
- [PlanetImportProcessUtil::addProblem](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/addProblem.md) &ndash; Logs a problem.
- [PlanetImportProcessUtil::doImportItem](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/doImportItem.md) &ndash; Imports the given planet and its dependencies recursively to given application directory.
- [PlanetImportProcessUtil::getErrorMessageByException](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/getErrorMessageByException.md) &ndash; Returns an error message corresponding to the given exception, and destined to an bashtml output.
- [PlanetImportProcessUtil::addWarnings](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/addWarnings.md) &ndash; Adds warnings with the given title.
- [PlanetImportProcessUtil::moveTmpBuildToApplication](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/moveTmpBuildToApplication.md) &ndash; Moves the tmp build directory content to the application directory.
- [PlanetImportProcessUtil::error](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/PlanetImportProcessUtil/error.md) &ndash; Throws an exception.





Location
=============
Ling\Light_PlanetInstaller\Util\PlanetImportProcessUtil<br>
See the source code of [Ling\Light_PlanetInstaller\Util\PlanetImportProcessUtil](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/Util/PlanetImportProcessUtil.php)



SeeAlso
==============
Previous class: [LpiRepositoryUtil](https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/Util/LpiRepositoryUtil.md)<br>
