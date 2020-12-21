<?php


namespace Ling\Light_PlanetInstaller\Service;


use Ling\Light\ServiceContainer\LightServiceContainerInterface;
use Ling\Light_PlanetInstaller\Exception\LightPlanetInstallerException;


/**
 * The LightPlanetInstallerService class.
 */
class LightPlanetInstallerService
{

    /**
     * This property holds the container for this instance.
     * @var LightServiceContainerInterface
     */
    protected $container;

    /**
     * This property holds the options for this instance.
     *
     * Available options are:
     *
     *
     *
     * See the @page(Light_PlanetInstaller conception notes) for more details.
     *
     *
     * @var array
     */
    protected $options;


    /**
     * Builds the LightPlanetInstallerService instance.
     */
    public function __construct()
    {
        $this->container = null;
        $this->options = [];
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
     * Sets the options.
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }












    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Throws an exception.
     *
     * @param string $msg
     * @throws \Exception
     */
    private function error(string $msg)
    {
        throw new LightPlanetInstallerException($msg);
    }

}