<?php


namespace Ling\Light_PlanetInstaller\CliTools\Command;

use Exception;
use Ling\CliTools\Command\CommandInterface;
use Ling\CliTools\Input\InputInterface;
use Ling\CliTools\Output\OutputInterface;
use Ling\Light_PlanetInstaller\CliTools\Program\LightPlanetInstallerApplication;

/**
 * The LightPlanetInstallerBaseCommand class.
 */
abstract class LightPlanetInstallerBaseCommand implements CommandInterface
{

    /**
     * This property holds the KaosApplication instance.
     * @var LightPlanetInstallerApplication
     */
    protected $application;


    /**
     * Builds the LightPlanetInstallerBaseCommand instance.
     */
    public function __construct()
    {
        $this->application = null;
    }


    /**
     * Runs the command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    abstract protected function doRun(InputInterface $input, OutputInterface $output);


    /**
     * @implementation
     */
    public function run(InputInterface $input, OutputInterface $output)
    {
        $this->application->setCurrentOutput($output);
        try {
            $this->doRun($input, $output);
        } catch (\Exception $e) {
            $this->application->logError($e);
        }
    }


    /**
     * Sets the application.
     *
     * @param LightPlanetInstallerApplication $application
     */
    public function setApplication(LightPlanetInstallerApplication $application)
    {
        $this->application = $application;
    }


    /**
     * Proxy to the application's hasLpiFile method.
     * @param array $options
     * @return bool
     */
    public function hasLpiFile(array $options = []): bool
    {
        return $this->application->hasLpiFile($options);
    }


    /**
     * Proxy to the application's createLpiFile method.
     */
    public function createLpiFile()
    {
        $this->application->createLpiFile();
    }

    /**
     * Proxy to the application's getLpiPath method.
     */
    public function getLpiPath(): string
    {
        return $this->application->getLpiPath();
    }


    /**
     * Proxy to the application's getUniversePath method.
     */
    public function getUniversePath(): string
    {
        return $this->application->getUniversePath();
    }


    /**
     * Proxy to the application's updateApplicationByLpiFile method.
     *
     * @param array $options
     */
    public function updateApplicationByLpiFile(array $options)
    {
        $this->application->updateApplicationByLpiFile($options);
    }

    /**
     * Proxy to the application's logError method.
     * @param string|Exception $error
     *
     */
    public function logError(string $error)
    {
        $this->application->logError($error);
    }


    /**
     * Proxy to the application's getBashtmlFormat method.
     *
     *
     * @param $type string
     * @throws \Exception
     * @return string
     *
     */
    protected function getBashtmlFormat(string $type): string
    {
        return $this->application->getBashtmlFormat($type);

    }

}