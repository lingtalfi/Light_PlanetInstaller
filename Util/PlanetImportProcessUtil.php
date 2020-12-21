<?php


namespace Ling\Light_PlanetInstaller\Util;

use Ling\Bat\CurrentProcess;
use Ling\Bat\FileSystemTool;
use Ling\CliTools\Output\OutputInterface;
use Ling\Light\ServiceContainer\LightServiceContainerInterface;
use Ling\Light_Logger\LightLoggerService;
use Ling\Light_PlanetInstaller\Exception\LightPlanetInstallerException;
use Ling\Light_PlanetInstaller\Helper\LpiGlobalDirHelper;
use Ling\UniverseTools\MetaInfoTool;
use Ling\UniverseTools\PlanetTool;

/**
 * The PlanetImportProcessUtil class.
 */
class PlanetImportProcessUtil
{

    /**
     * This property holds the container for this instance.
     * @var LightServiceContainerInterface
     */
    protected $container;


    /**
     * This property holds the output for this instance.
     * @var OutputInterface
     */
    protected $output;

    /**
     * This property holds the problems for this instance.
     * @var array
     */
    protected $problems;

    /**
     * Whether to turn on the devMode.
     * In dev mode:
     * - show exception trace in error messages
     * - don't delete the tmp build directory (so that the dev can inspect it)
     *
     * @var bool = false
     */
    private $devMode;

    /**
     * This property holds the planetInstallList for this instance.
     * It's an array of planetDotName => realVersion.
     * It doesn't contain the main planet, which should be installed last is referred by the mainPlanet property below.
     *
     *
     * @var array
     */
    private $planetInstallList;

    /**
     * This property holds the mainPlanet for this instance.
     * @var string
     */
    private $mainPlanet;

    /**
     * This property holds the mainPlanetVersion for this instance.
     * @var string
     */
    private $mainPlanetVersion;

    /**
     * The current indent level.
     * @var int = 0
     */
    private $indent;

    /**
     * The indentChars used to indent log lines.
     * @var string
     */
    private $indentChars;

    /**
     * Whether to execute as much of the process as you can, even if it contains errors.
     * Note that this might lead to non atomic/inconsistent installation.
     * It's generally not recommended to use this mode, unless you're aware of what problems the non-forced installation
     * has and you're ok with it.
     *
     * @var bool = false
     */
    private $forceMode;

    /**
     * This property holds the applicationDir for this instance.
     * @var string
     */
    private $applicationDir;


    /**
     * Builds the PlanetInstallerUtil instance.
     */
    public function __construct()
    {
        $this->container = null;
        $this->output = null;
        $this->devMode = false;
        $this->forceMode = false;
        $this->problems = [];
        $this->planetInstallList = [];
        $this->mainPlanet = null;
        $this->mainPlanetVersion = null;
        $this->indent = 0;
        $this->applicationDir = null;
        $this->indentChars = (true === CurrentProcess::isCli()) ? ' ' : '-';
    }

    /**
     * Sets the container.
     *
     * @param LightServiceContainerInterface $container
     */
    public function setContainer(LightServiceContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Sets the output.
     *
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * Sets the devMode.
     *
     * @param bool $devMode
     */
    public function setDevMode(bool $devMode)
    {
        $this->devMode = $devMode;
    }

    /**
     * Sets the forceMode.
     *
     * @param bool $forceMode
     */
    public function setForceMode(bool $forceMode)
    {
        $this->forceMode = $forceMode;
    }


    /**
     * Imports the given planet and its dependencies recursively to the destination directory.
     *
     * @param string $planetDot
     * @param string $versionExpr
     * @param string $applicationDir
     */
    public function importTo(string $planetDot, string $versionExpr, string $applicationDir)
    {

        // things to output to the user
        $failureReasons = [];
        $planetInstallList = [];


        // ___
        $this->applicationDir = $applicationDir;
        $this->mainPlanet = $planetDot;
        $this->planetInstallList = []; // reset the planetInstall list for each item
        $tmpDir = rtrim(sys_get_temp_dir(), '/') . "/universe/Ling/Light_PlanetInstaller/build";
        $this->indent = 0;
        $returnCode = $this->doImportItem($planetDot, $versionExpr, $tmpDir);
        if(1 === $returnCode){
            /**
             * The planet already exists in the target app ? -> skipping. Nothing left to do.
             */
            return;
        }


        //--------------------------------------------
        // ESTIMATE THE POTENTIAL PROBLEMS
        //--------------------------------------------
        $canInstallSafely = true;
        $errMsg = null;
        $noPlanetFound = $this->problems["noPlanetFound"] ?? [];
        $warnings = $this->problems["warning"] ?? [];

        if (false === empty($noPlanetFound)) {
            $canInstallSafely = false;
            $errMsg = "<error>The following planets couldn't be found: </error>" . PHP_EOL;
            $c = 0;
            foreach ($noPlanetFound as $item) {
                list($planetDot, $versionExpr) = $item;
                $errMsg .= "- <b>$planetDot:$versionExpr</b>" . PHP_EOL;
                $c++;
            }
        }

        if (true === $canInstallSafely) {
            $this->moveTmpBuildToApplication($tmpDir, $applicationDir);


            $this->output->write(PHP_EOL);
            $this->output->write("----------------" . PHP_EOL);
            $this->output->write("<green:bgLightGreen>RESULT</green:bgLightGreen>" . PHP_EOL);
            $this->output->write("----------------" . PHP_EOL);

            $this->output->write("<success>The process was successfully executed.</success>" . PHP_EOL);


        } else {
            /**
             * Explain to the user why we didn't install
             */

            if (true === $this->forceMode) {
                $this->moveTmpBuildToApplication($tmpDir, $applicationDir);
            }


            $this->output->write(PHP_EOL);
            $this->output->write("----------------" . PHP_EOL);
            $this->output->write("<red:bgBlack>RESULT</red:bgBlack>" . PHP_EOL);
            $this->output->write("----------------" . PHP_EOL);
            if (false === $this->forceMode) {
                $this->output->write("<error>The process was interrupted.</error>" . PHP_EOL);
                $this->output->write($errMsg);
                $this->output->write("<blue>You can force the process to execute nonetheless, using the -f flag</blue>." . PHP_EOL);
            } else {
                $this->output->write("<error>The process was forced, despite the following error:</red:bgBlack>" . PHP_EOL);
                $this->output->write($errMsg);
            }
        }


        if ($warnings) {
            $this->output->write("<blue>The following warnings were raised during the process execution:</blue>" . PHP_EOL);
            $c = 1;
            foreach ($warnings as $cmdWarnings) {
                $this->output->write("<warning:bgBlack>$c</warning:bgBlack>" . PHP_EOL);
                foreach ($cmdWarnings as $warning) {
                    $this->output->write('<warning>' . $warning . '</warning>' . PHP_EOL);
                }
                $c++;
            }
        } else {
            $this->output->write("<blue>No warnings were raised during the process execution.</blue>" . PHP_EOL);
        }


        if (false === $this->devMode) {
            /**
             * Always clean after usage
             */
            FileSystemTool::remove($tmpDir);
        }

    }


    /**
     * Returns the problems that occurred during this process.
     * @return array
     */
    public function getProblems(): array
    {
        return $this->problems;
    }



    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Logs some message.
     *
     * @param string $type
     * @param $msg
     */
    protected function log(string $type, $msg)
    {
        $sPrefix = str_repeat($this->indentChars, $this->indent * 6);
        if ('' !== trim($sPrefix)) {
            $sPrefix .= ' ';
        }

        if ($this->container->has("logger")) {
            /**
             * @var $lg LightLoggerService
             */
            $lg = $this->container->get("logger");


            $lg->log($sPrefix . "$type: $msg", "lpi-process");
        }
        $this->output->write($sPrefix . $type . ": " . $msg);
    }


    /**
     * Logs a problem.
     *
     * @param string $code
     * @param string $message
     */
    protected function addProblem(string $code)
    {
        $args = func_get_args();
        array_shift($args);
        $this->problems[$code][] = $args;
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Imports the given planet and its dependencies recursively to given application directory.
     * Returns a return code, amongst the following:
     *
     * - 0: by default
     * - 1: the planetDot was found in the app, so the process was skipped
     *
     *
     * @param string $planetDot
     * @param string $versionExpr
     * @param string $applicationDir
     *
     * @return int
     */
    private function doImportItem(string $planetDot, string $versionExpr, string $applicationDir): int
    {


        $returnCode = 0;

        try {


            $util = new LpiRepositoryUtil();
            $util->setAppDir($this->applicationDir); // note the applicationDir is not the same as the argument $applicationDir !!


            $this->log("debug", "call <red>importTo</red> with <b>$planetDot</b> and versionExpr=<b>$versionExpr</b>...");


            $matchingInfo = $util->getFirstMatchingInfo($planetDot, $versionExpr);



            if (false !== $matchingInfo) {
                $repo = $matchingInfo['repo'];
                $realVersion = $matchingInfo['version'];
                $this->log("debug", "a match was found in repo=<b>" . $repo . "</b>, with realVersion=<b>" . $realVersion . "</b>." . PHP_EOL);


                if ('app' === $repo) {
                    /**
                     * If the planet to install already exists in the app,
                     * we assume that it has been installed correctly and therefore doesn't need to be reinstalled.
                     *
                     * Tip for the user: delete the planet manually to re-trigger the installation if that's what you want.
                     */
                    $returnCode = 1;
                    $this->log("debug", "The planet already exists in the application, skipping." . PHP_EOL);
                } else {


                    switch ($repo) {
                        case "web":
                        case "global":
                            list($galaxy, $planet) = PlanetTool::extractPlanetDotName($planetDot);

                            if ('web' === $repo) {
                                $repository = $util->getWebRepository();
                            } else {
                                $repository = $util->getGlobalDirRepository();
                            }


                            $this->log("debug", "listing dependencies for <b>$planetDot:$realVersion</b>...");
                            $dependencies = $repository->getDependencies($planetDot, $realVersion);

                            $nbDependencies = count($dependencies);
                            $sDep = (1 === $nbDependencies) ? 'dependency' : 'dependencies';
                            $this->log("debug", "$nbDependencies $sDep found." . PHP_EOL);


                            if ($nbDependencies > 0) {
                                $this->log("debug", "Processing dependencies for planet <b>$planetDot:$realVersion</b>." . PHP_EOL);


                                $this->indent++;
                                foreach ($dependencies as $dependency) {
                                    list($depPlanetDot, $depVersionExpr) = $dependency;


                                    if (
                                        $this->mainPlanet !== $depPlanetDot &&
                                        false === array_key_exists($depPlanetDot, $this->planetInstallList)
                                    ) {
                                        $this->planetInstallList[$depPlanetDot] = null; // it's just temporary, to avoid infinite loop, we need to store the real version later
                                        $this->doImportItem($depPlanetDot, $depVersionExpr, $applicationDir);

                                        list($depGalaxy, $depPlanet) = PlanetTool::extractPlanetDotName($depPlanetDot);
                                        $depPlanetDir = $applicationDir . "/universe/$depGalaxy/$depPlanet";
                                        $depRealVersion = MetaInfoTool::getVersion($depPlanetDir);
                                        $this->planetInstallList[$depPlanetDot] = $depRealVersion;
                                    }
                                }
                                $this->indent--;
                            }


                            $warnings = [];
                            $planetDstDir = $applicationDir . "/universe/$galaxy/$planet";
                            $this->log("debug", "copying <b>$planetDot:$realVersion</b> from web to <blue>$planetDstDir</blue>." . PHP_EOL);
                            $repository->copy($planetDot, $realVersion, $planetDstDir, $warnings);


                            if ('web' === $repo) {
                                $this->log("debug", "creating a copy to the global dir." . PHP_EOL);
                                LpiGlobalDirHelper::copyToGlobalDir($galaxy, $planet, $realVersion, $planetDstDir);
                            }


                            if ($warnings) {
                                $this->addWarnings("Warnings from the web repository while importing <b>$planetDot:$versionExpr</b>: ", $warnings);
                            }


                            break;
                        default:
                            $this->error("Unknown repo $repo.");
                            break;
                    }
                }

            } else {
                $this->log("debug", "<error>no match found.</error>" . PHP_EOL);
                $this->addProblem("noPlanetFound", $planetDot, $versionExpr);
            }
        } catch (\Exception $e) {
            $msg = $this->getErrorMessageByException($e);
            $this->log("error", $msg);
        }
        return $returnCode;
    }


    /**
     * Returns an error message corresponding to the given exception, and destined to an bashtml output.
     *
     * @param \Exception $e
     * @return string
     */
    private function getErrorMessageByException(\Exception $e): string
    {
        $s = '<red>';
        if (true === $this->devMode) {
            $s .= "$e";
        } else {
            $s .= $e->getMessage();
        }
        $s .= '</red>';
        return $s;
    }


    /**
     * Adds warnings with the given title.
     *
     * @param string $title
     * @param array $warnings
     */
    private function addWarnings(string $title, array $warnings)
    {
        foreach ($warnings as $warning) {
            $msg = $title . $warning;
            $n = substr_count($warning, PHP_EOL);
            $titleSep = ($n > 0) ? PHP_EOL : '';


            $msg2 = $title . $titleSep . '<warning>' . $warning . '</warning>' . PHP_EOL;
            $this->addProblem('warning', $msg);
            $this->log("warning", $msg2);
        }
    }


    /**
     * Moves the tmp build directory content to the application directory.
     *
     * @param string $tmpBuildDir
     * @param string $applicationDir
     */
    private function moveTmpBuildToApplication(string $tmpBuildDir, string $applicationDir)
    {
        $buildUniverse = $tmpBuildDir . "/universe";
        $planetDirs = PlanetTool::getPlanetDirs($buildUniverse);
        foreach ($planetDirs as $planetDir) {
            list($galaxy, $planet) = PlanetTool::getGalaxyNamePlanetNameByDir($planetDir);
            $version = PlanetTool::getVersionByPlanetDir($planetDir);

            $appPlanetDir = $applicationDir . "/universe/$galaxy/$planet";


            $this->log("debug", "Moving planet $galaxy.$planet with version $version from build to app (<blue>$planetDir</blue> to <blue>$appPlanetDir</blue>)." . PHP_EOL);

            $this->indent++;

            // the planet already exists
            if (is_dir($appPlanetDir)) {
                $appVersion = MetaInfoTool::getVersion($appPlanetDir);
                /**
                 *
                 * Shouldn't happen in theory, since the calling method probably did this check already,
                 * but if it happens, continuing with the same philosophy, we do nothing (i.e. don't overwrite the existing directory).
                 */
                if ($appVersion === $version) {
                    $this->log("debug", "Planet $galaxy.$planet: $appVersion already found in app, skipping." . PHP_EOL);
                    continue;
                } else {
                    /**
                     * remove the previous app planet first
                     */
                    $this->log("debug", "Remove planet $galaxy.$planet: $appVersion from app" . PHP_EOL);
                    PlanetTool::removePlanet($galaxy . "." . $planet, $applicationDir);
                }

            }
            $this->log("debug", "Moving planet $galaxy.$planet:$version from tmp build to <blue>$appPlanetDir</blue>." . PHP_EOL);
            FileSystemTool::copyDir($planetDir, $appPlanetDir);
            $this->indent--;
        }
    }


    /**
     * Throws an exception.
     * @param string $msg
     * @param int|null $code
     * @throws \Exception
     */
    private function error(string $msg, int $code = null)
    {
        throw new LightPlanetInstallerException($msg, $code);
    }
}