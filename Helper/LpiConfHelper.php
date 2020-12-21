<?php


namespace Ling\Light_PlanetInstaller\Helper;


use Ling\BabyYaml\BabyYamlUtil;
use Ling\Light_PlanetInstaller\Exception\LightPlanetInstallerException;

/**
 * The LpiConfHelper class.
 */
class LpiConfHelper
{


    /**
     * Returns the path to the root dir (containing the global conf, lpi master etc...).
     * @return string
     */
    public static function getCliRootDir(): string
    {
        return '/usr/local/share/universe/Ling/Light_PlanetInstaller';
    }


    /**
     * Returns the path to the global configuration file.
     *
     * @return string
     */
    public static function getConfPath(): string
    {
        return self::getCliRootDir() . "/conf.byml";
    }


    /**
     *
     * Returns a value from the global configuration file.
     * If not found returns the default value by default, or throws an exception if $throwEx=true.
     *
     *
     * @param string $key
     * @param null $default
     * @param bool $throwEx
     * @return mixed
     * @throws \Exception
     */
    public static function getConfValue(string $key, $default = null, bool $throwEx = false)
    {
        $globalConfPath = self::getConfPath();

        if (true === file_exists($globalConfPath)) {
            $arr = BabyYamlUtil::readFile($globalConfPath);
            if (array_key_exists($key, $arr)) {
                return $arr[$key];
            }
        }
        if (false === $throwEx) {
            return $default;
        }
        throw new LightPlanetInstallerException("Configuration value not found with key=$key.");
    }


    /**
     * Returns the path to the global directory.
     *
     * @return string
     */
    public static function getGlobalDirPath(): string
    {
        $default = self::getCliRootDir() . "/planets";
        return self::getConfValue("global_dir_path", $default);
    }


    /**
     * Returns the path to the master lpi file.
     *
     * @return string
     */
    public static function getMasterFilePath(): string
    {
        $default = self::getCliRootDir() . "/lpi-master.byml";
        return self::getConfValue("master_path", $default);
    }


    /**
     * Returns the path to the master version file.
     *
     * @return string
     */
    public static function getMasterVersionFilePath(): string
    {
        $default = self::getCliRootDir() . "/lpi-master-version.byml";
        return self::getConfValue("master_version_path", $default);
    }


}