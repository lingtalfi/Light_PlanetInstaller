<?php


namespace Ling\Light_PlanetInstaller\Helper;

use Ling\Light_PlanetInstaller\Exception\LightPlanetInstallerException;
use Ling\Light_PlanetInstaller\Repository\LpiRepositoryInterface;
use Ling\Light_PlanetInstaller\Repository\LpiWebRepository;

/**
 * The LpiVersionHelper class.
 */
class LpiVersionHelper
{

    /**
     * Returns whether $version fits the $versionExpr for the given repository.
     *
     * @param string $planetDot
     * @param string $version
     * @param string $versionExpr
     * @param LpiRepositoryInterface $repository
     * @return bool
     */
    public static function versionMatchesVersionExpression(string $planetDot, string $version, string $versionExpr, LpiRepositoryInterface $repository): bool
    {

        if ('last' === $versionExpr) {
            $resolvedVersionExpr = LpiMasterHelper::getLatestVersionByPlanet($planetDot);
            return (string)$version === (string)$resolvedVersionExpr;
        } else {
            if ('+' === substr($versionExpr, -1)) {
                $resolvedVersionExpr = substr($versionExpr, 0, -1);
                return (string)$version >= (string)$resolvedVersionExpr;
            } else {
                return (string)$version === (string)$versionExpr;
            }
        }
    }


    /**
     * Returns whether version is strictly greater than version 2.
     * If orEqual flag is true, returns whether v1 is greater or equal to v2.
     *
     *
     * @param string $realVersion1
     * @param string $realVersion2
     * @param bool $orEqual
     * @return bool
     */
    public static function compare(string $realVersion1, string $realVersion2, bool $orEqual = false): bool
    {
        $p1 = explode(".", $realVersion1);
        $p2 = explode(".", $realVersion2);
        $c1 = count($p1);
        $c2 = count($p2);


        /**
         * equalizing, just in case two version numbers don't have the same subnumbers (i.e. 1.4.5 vs 1.4)
         */
        $max = $c1;
        if ($c1 !== $c2) {
            if ($c1 > $c2) {
                $max = $c1;
                $offset = $c1 - $c2;
                for ($i = 0; $i < $offset; $i++) {
                    $p2[] = "0";
                }
            } else {
                $max = $c2;
                $offset = $c2 - $c1;
                for ($i = 0; $i < $offset; $i++) {
                    $p1[] = "0";
                }
            }
        }


        $cpt = 1;
        foreach ($p1 as $number) {
            $p2Number = array_shift($p2);
            if ($number > $p2Number) {
                return true;
            } else {
                if ($number < $p2Number) {
                    return false;
                } else {
                    if ($max === $cpt && true === $orEqual) {
                        return true;
                    }
                }
            }
            $cpt++;
        }
        return false;
    }


    /**
     * Returns the first real version number of the planet that matches $versionExpr, or false if not possible.
     *
     *
     * @param string $planetDot
     * @param $versionExpr
     * @param LpiRepositoryInterface $repository
     * @return false|string
     */
    public static function getFirstMatchingVersionByRepository(string $planetDot, $versionExpr, LpiRepositoryInterface $repository)
    {
        if ('last' === $versionExpr) {
            if ($repository instanceof LpiWebRepository) {
                /**
                 * Note: we don't use the repository instance here because it doesn't have the method we want,
                 * but it doesn't matter, in the end we fetch the "last" version from the web anyway.
                 */
                return LpiWebHelper::getPlanetCurrentVersion($planetDot);
            }
            /**
             * See LpiRepositoryUtil->getFirstMatchingInfo for how it's supposed to work.
             * Basically, "last" means fetch the web.
             *
             */
            $sClass = get_class($repository);
            throw new LightPlanetInstallerException("The \"last\" keyword is only allowed with a LpiWebRepository instance, $sClass given.");
        } else {
            if ('+' === substr($versionExpr, -1)) {
                $minVersion = substr($versionExpr, 0, -1);
                return $repository->getFirstVersionWithMinimumNumber($planetDot, $minVersion);
            } else {
                $realVersion = $versionExpr;
                if (true === $repository->hasPlanet($planetDot, $realVersion)) {
                    return $realVersion;
                }
            }
        }
        return false;
    }


    /**
     * Returns whether the given versionExpression ends with the plus symbol.
     *
     * @param string $versionExpr
     * @return bool
     */
    public static function isPlus(string $versionExpr): bool
    {
        return '+' === substr($versionExpr, -1);
    }


    /**
     * Removes the trailing plus symbol from the given version expression and returns the result.
     *
     * @param string $versionExpr
     * @return string
     */
    public static function removePlus(string $versionExpr): string
    {
        return rtrim($versionExpr, "+");
    }
}