<?php


namespace Ling\Light_PlanetInstaller\CliTools\Program;

use Exception;
use Ling\BabyYaml\BabyYamlUtil;
use Ling\Bat\FileSystemTool;
use Ling\CliTools\Command\CommandInterface;
use Ling\CliTools\Input\InputInterface;
use Ling\CliTools\Output\OutputInterface;
use Ling\CliTools\Program\Application;
use Ling\CliTools\Util\LoaderUtil;
use Ling\Light\ServiceContainer\LightServiceContainerInterface;
use Ling\Light_Logger\LightLoggerService;
use Ling\Light_PlanetInstaller\CliTools\Command\LightPlanetInstallerBaseCommand;
use Ling\Light_PlanetInstaller\Exception\LightPlanetInstallerException;
use Ling\Light_PlanetInstaller\Helper\LpiConfHelper;
use Ling\Light_PlanetInstaller\Helper\LpiVersionHelper;
use Ling\Light_PlanetInstaller\Helper\LpiWebHelper;
use Ling\Light_PlanetInstaller\Util\PlanetImportProcessUtil;
use Ling\UniverseTools\MetaInfoTool;
use Ling\UniverseTools\PlanetTool;

/**
 * The LightPlanetInstallerApplication class.
 *
 *
 * Nomenclature
 * ----------------
 *
 * ### planetInfo
 * The planetInfo array is an array with the following structure:
 *
 * - 0: planet path     (string)
 * - 1: galaxy name     (string)
 * - 2: planet name     (string)
 * - 3: real version number  (string)
 *
 *
 *
 */
class LightPlanetInstallerApplication extends Application
{


    /**
     * This property holds the currentDirectory when this instance was first instantiated.
     * @var string
     */
    protected $currentDirectory;

    /**
     * This property holds the current output for this instance.
     *
     * It's set by a command when the command is executed.
     *
     * @var OutputInterface
     */
    protected $currentOutput;


    /**
     * This property holds the container for this instance.
     * @var LightServiceContainerInterface
     */
    protected $container;


    /**
     * This property holds the devMode for this instance.
     * In dev mode, exceptions trace are displayed directly in the console output.
     *
     *
     * @var bool
     */
    protected $devMode;

    /**
     * This property holds the notFoundPlanets for this instance.
     * @var array
     */
    protected $notFoundPlanets;


    /**
     * @overrides
     */
    public function __construct()
    {
        parent::__construct();

        $this->container = null;
        $this->currentOutput = null;
        $this->currentDirectory = getcwd();


        $this->devMode = false;

        $this->registerCommand("Ling\Light_PlanetInstaller\CliTools\Command\HelpCommand", "help");
        $this->registerCommand("Ling\Light_PlanetInstaller\CliTools\Command\ImportCommand", "import");
        $this->registerCommand("Ling\Light_PlanetInstaller\CliTools\Command\OpenDirCommand", "dir");
        $this->registerCommand("Ling\Light_PlanetInstaller\CliTools\Command\OpenConfCommand", "conf");
        $this->registerCommand("Ling\Light_PlanetInstaller\CliTools\Command\OpenMasterCommand", "master");
        $this->registerCommand("Ling\Light_PlanetInstaller\CliTools\Command\ListCommand", "list");
        $this->registerCommand("Ling\Light_PlanetInstaller\CliTools\Command\InitCommand", "init");


        $this->notFoundPlanets = [];
    }



    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * @overrides
     */
    protected function runProgram(InputInterface $input, OutputInterface $output)
    {
        if (true === $input->hasFlag('dev')) {
            $this->devMode = true;
        }
        return parent::runProgram($input, $output);
    }




    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Returns the @page(bashtml) format to use for the given element type.
     *
     *
     * @param string $type
     * @return string
     * @throws Exception
     */
    public function getBashtmlFormat(string $type): string
    {
        $tint = 'blue';
        switch ($type) {
            case "planet":
            case "file":
                return $tint;
            case "number":
            case "counterPrefix":
                return 'b:' . $tint;
            case "command":
                return 'b';
            case "error":
                return 'error';
            default:
                $this->error("Unknown format type $type.");
                break;
        }
    }




    //--------------------------------------------
    //
    //--------------------------------------------
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
     * Returns whether there is a lpi file in the current application.
     * This command assumes that the user is located at the root of the application.
     *
     * Available options are:
     * - appDir: string=null, the app directory to use. If null, defaults to the current directory.
     *
     *
     *
     * @param array $options
     * @return bool
     */
    public function hasLpiFile(array $options = []): bool
    {
        $lpiFile = $this->getLpiPath($options);
        return file_exists($lpiFile);
    }

    /**
     * Sets the currentOutput.
     *
     * @param OutputInterface $currentOutput
     */
    public function setCurrentOutput(OutputInterface $currentOutput)
    {
        $this->currentOutput = $currentOutput;
    }


    /**
     * Creates the lpi file for this application if it doesn't exist yet.
     * If the file already exists, it will do nothing.
     *
     * This command assumes that the user is located at the root of the application.
     */
    public function createLpiFile()
    {


        $lpiFile = $this->getLpiPath();

        if (false === file_exists($lpiFile)) {


            $planetsInfo = $this->getPlanetsInfo();


            $nbItems = count($planetsInfo);
            $loader = new LoaderUtil();
            $loader->setOutput($this->currentOutput);
            $loader->setNbTotalItems($nbItems);


            $loader->start();


            $planetItems = [];

            foreach ($planetsInfo as $planetInfo) {

                list($planetPath, $galaxy, $planet, $version) = $planetInfo;
                $planetItems[$galaxy . "." . $planet] = $version . "+";
                $this->copyToGlobalDir($planetPath, $galaxy, $planet, $version);
                $loader->incrementBy(1);
            }

            //--------------------------------------------
            // CREATING THE LPI FILE
            //--------------------------------------------
            BabyYamlUtil::writeFile([
                'planets' => $planetItems,
            ], $lpiFile);

        }
    }

    /**
     * Returns the path where the lpi file is supposed to be.
     *
     * Available options are:
     * - appDir: string=null, the directory of the application to use. If null, defaults to the current directory.
     *
     *
     *
     * @param array $options
     * @return string
     */
    public function getLpiPath(array $options = []): string
    {
        $appDir = $options['appDir'] ?? null;
        if (null === $appDir) {
            $appDir = $this->currentDirectory;
        }
        return $appDir . "/lpi.byml";
    }


    /**
     * Returns the path to the application's universe directory
     * @return string
     */
    public function getUniversePath(): string
    {
        return $this->currentDirectory . "/universe";
    }


    /**
     * Copies the given planet directory and its content to the global directory, in a directory named after the given $galaxy, $planet and $version.
     *
     * @param string $planetPath
     * @param string $galaxy
     * @param string $planet
     * @param string $version
     */
    public function copyToGlobalDir(string $planetPath, string $galaxy, string $planet, string $version)
    {
        $globalDir = LpiConfHelper::getGlobalDirPath();
        $newDir = $globalDir . "/" . "$galaxy.$planet.$version";
        if (false === is_dir($newDir)) {
            FileSystemTool::copyDir($planetPath, $newDir);
        }
    }


    /**
     * Returns the list of elements to update in the current app, based on their definition in the lpi file.
     *
     * Basically, when an element is defined in the lpi file and does not have an exact correspondence in the app, it's added to the returned list.
     *
     * The returned list is an array of @page(planet dot name) => versionExpression
     *
     * The versionExpression is defined in the @page(Light_PlanetInstaller conception notes).
     *
     * Available options are:
     * - appDir: string=null, the application dir to use. If null, defaults to the current directory.
     *
     *
     *
     * @param array $options
     * @return array
     */
    public function lpiDiff(array $options = []): array
    {
        $appDir = $options['appDir'] ?? null;
        if (null === $appDir) {
            $appDir = $this->currentDirectory;
        }


        $diff = [];
        $planetsInfoLpi = $this->getPlanetsInfoFromLpi([
            'appDir' => $appDir,
        ]);


        // optimizing for comparison
        $planetsInfoApp = $this->getPlanetsInfo([
            "appDir" => $appDir,
        ]);
        $appArr = [];
        foreach ($planetsInfoApp as $item) {
            list($planetPath, $galaxy, $planet, $version) = $item;
            $appArr[$galaxy . "." . $planet] = $version;
        }

        foreach ($planetsInfoLpi as $planetDot => $versionExpr) {
            $versionExpr = (string)$versionExpr;


            $addToDiff = false;


            if (false === array_key_exists($planetDot, $appArr)) {
                $addToDiff = true;
            } else {

                $planetCurrentVersion = (string)$appArr[$planetDot];

                switch ($versionExpr) {
                    case "last":
                        $planetWebVersion = LpiWebHelper::getPlanetCurrentVersion($planetDot);
                        if ($planetWebVersion !== $planetCurrentVersion) {
                            $addToDiff = true;
                        }
                        break;
                    default:

                        if (true === LpiVersionHelper::isPlus($versionExpr)) {
                            $desiredMinVersion = LpiVersionHelper::removePlus($versionExpr);
                            if ($desiredMinVersion > $planetCurrentVersion) {
                                $addToDiff = true;
                            } else {
                                /**
                                 * The planet in the current app has already a bigger version number, so it's ok we do nothing
                                 */
                            }

                        } elseif ($versionExpr !== $appArr[$planetDot]) {
                            $addToDiff = true;
                        }

                        break;
                }


            }


            if (true === $addToDiff) {
                $diff[$planetDot] = $versionExpr;
            }
        }

        return $diff;
    }


    /**
     * Updates the application planets using the lpi file as a reference.
     *
     * Available options are:
     * - mode: string(import|install)=import. Whether to use import or install for each planet.
     * - appDir: string|null = null, the target application directory where to import/install the plugin(s).
     *      If null, the current directory will be used (assuming the user called this command from the target app's root dir).
     *
     *
     *
     * @param array $options
     */
    public function updateApplicationByLpiFile(array $options = [])
    {
        $mode = $options['mode'] ?? 'import';
        $appDir = $options['appDir'] ?? null;
        if (null === $appDir) {
            $appDir = $this->currentDirectory;
        }

        $this->useNotFoundPlanets();
        $output = $this->currentOutput;


        if ('import' === $mode) {


            $lpiDiff = $this->lpiDiff([
                "appDir" => $appDir,
            ]);




            $u = new PlanetImportProcessUtil();

//            $u->setDevMode(true);
//            $u->setForceMode(true);

            $u->setContainer($this->container);
            $u->setOutput($output);


            foreach ($lpiDiff as $planetDot => $versionExpr) {
                $u->importTo($planetDot, $versionExpr, $appDir);
            }

            /**
             *
             * todo: doesn't work declared lpi files not installed in target app
             * todo: doesn't work declared lpi files not installed in target app
             * todo: doesn't work declared lpi files not installed in target app
             * todo: doesn't work declared lpi files not installed in target app
             * todo: doesn't work declared lpi files not installed in target app
             *
             * todo: here, what's difference betweeb problems and warning?
             * todo: here, what's difference betweeb problems and warning?
             * todo: here, what's difference betweeb problems and warning?
             * todo: here, what's difference betweeb problems and warning?
             * todo: here, what's difference betweeb problems and warning?
             */
            a($u->getProblems());


        } else {
            $this->error("Unknown mode \"$mode\".");
        }
    }


    /**
     * Writes an error message to the log, and prints it to the output too.
     *
     *
     * @param string|Exception $error
     * @throws \Exception
     *
     */
    public function logError($error)
    {
        if ($error instanceof \Exception) {
            $errorLog = date("Y-m-d H:i:s") . " - " . $error; // we want the full trace in the log
            $errorOutput = $error->getMessage();
            if (true === $this->devMode) {
                $errorOutput .= PHP_EOL . PHP_EOL . $error->getTraceAsString();
            }

        } else {
            $error = date("Y-m-d H:i:s") . " - " . $error;
            $errorLog = $errorOutput = $error;
        }


        if ($this->container->has('logger')) {
            /**
             * @var $lg LightLoggerService
             */
            $lg = $this->container->get("logger");
            $lg->log($errorLog, "lpi_error");
        }

        $this->currentOutput->write(PHP_EOL . '<error>' . $errorOutput . '</error>' . PHP_EOL);
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * @overrides
     */
    protected function onCommandInstantiated(CommandInterface $command)
    {
        if ($command instanceof LightPlanetInstallerBaseCommand) {
            $command->setApplication($this);
        } else {
            throw new LightPlanetInstallerException("All commands must inherit LightPlanetInstallerBaseCommand.");
        }
    }




    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Throws an exception.
     *
     * @param string $msg
     * @param int|null $code
     * @throws \Exception
     */
    private function error(string $msg, int $code = null)
    {
        throw new LightPlanetInstallerException($msg, $code);
    }


    /**
     * Returns an array of items containing information about the planets of the current app.
     * Each item is a planetInfo array (see this class' top comment for more details).
     *
     * Available options are:
     * - appDir: string=null, the application directory to use. If null, defaults to the current directory.
     *
     *
     * @param array $options
     * @return array
     */
    private function getPlanetsInfo(array $options = []): array
    {
        $appDir = $options['appDir'] ?? null;
        if (null === $appDir) {
            $appDir = $this->currentDirectory;
        }


        $planetsInfo = [];
        $universeDir = $appDir . "/universe";
        if (true === is_dir($universeDir)) {
            $planets = PlanetTool::getPlanetDirs($universeDir);
            foreach ($planets as $planetPath) {
                $version = MetaInfoTool::getVersion($planetPath);
                if (false === empty($version)) {
                    list($galaxy, $planet) = PlanetTool::getGalaxyNamePlanetNameByDir($planetPath);
                    $planetsInfo[] = [
                        $planetPath,
                        $galaxy,
                        $planet,
                        $version,
                    ];
                } else {
                    /**
                     * If the version is null, it's probably a test or temporary planet created by the user.
                     * If it doesn't have a version number yet, we just ignore it.
                     */
                }
            }
        } else {
            /**
             * If the universe dir doesn't exist, maybe it's a new project, in which case it makes sense to have an empty lpi file.
             */
        }
        return $planetsInfo;
    }


    /**
     * Returns an array of @page(planet dot name) => versionExpression contained in the lpi.byml file.
     *
     * If the lpi file doesn't exist, an exception is thrown.
     *
     * The versionExpression is defined in the @page(Light_PlanetInstaller conception notes).
     *
     * Available options are:
     * - appDir: string=null, the application directory to use. If null, defaults to the current directory.
     *
     *
     *
     * @param array $options
     * @return array
     */
    private function getPlanetsInfoFromLpi(array $options = []): array
    {
        $appDir = $options['appDir'] ?? null;
        if (null === $appDir) {
            $appDir = $this->currentDirectory;
        }


        $lpiFile = $this->getLpiPath([
            'appDir' => $appDir,
        ]);
        if (false === file_exists($lpiFile)) {
            $this->error("Lpi file not found: $lpiFile.");
        }

        $arr = BabyYamlUtil::readFile($lpiFile);
        return $arr['planets'] ?? [];
    }


    /**
     * Returns the number of items defined in the planets section of the lpi file.
     *
     *
     * @return int
     */
    private function countPlanetsFromLpi(): int
    {
        $lpiFile = $this->getLpiPath();
        if (false === file_exists($lpiFile)) {
            return 0;
        }
        $arr = BabyYamlUtil::readFile($lpiFile);
        $planets = $arr['planets'] ?? [];
        return count($planets);
    }


    /**
     * Resets the notFoundPlanets array
     */
    private function useNotFoundPlanets()
    {
        $this->notFoundPlanets = [];
    }


    /**
     * Adds the given planet to the list of not found planets.
     *
     * @param string $planetDot
     * @param string $versionExpr
     */
    private function addNotFoundPlanet(string $planetDot, string $versionExpr)
    {
        $this->notFoundPlanets[] = $planetDot . ":" . $versionExpr;
    }


    /**
     * Outputs the list of not found planets.
     */
    private function displayNotFoundPlanetList()
    {
        if ($this->notFoundPlanets) {
            $output = $this->currentOutput;
            $f1 = $this->getBashtmlFormat('error');


            $output->write("<$f1>The following planets were not found:</$f1>" . PHP_EOL);
            foreach ($this->notFoundPlanets as $line) {
                list($planetDot, $versionExpr) = explode(':', $line);
                $output->write(substr(" ", 4) . "- <$f1>" . $planetDot . " " . $versionExpr . '</$f1>' . PHP_EOL);
            }
        }
    }
}