<?php


namespace Ling\Light_PlanetInstaller\Util;


use Ling\Light_PlanetInstaller\Helper\LpiVersionHelper;
use Ling\Light_PlanetInstaller\Repository\LpiApplicationRepository;
use Ling\Light_PlanetInstaller\Repository\LpiGlobalDirRepository;
use Ling\Light_PlanetInstaller\Repository\LpiRepositoryInterface;
use Ling\Light_PlanetInstaller\Repository\LpiWebRepository;

/**
 * The LpiRepositoryUtil class.
 */
class LpiRepositoryUtil
{


    /**
     * This property holds the appDir for this instance.
     * @var string
     */
    protected $appDir;


    /**
     * This property holds the appRepo for this instance.
     * @var LpiRepositoryInterface
     */
    private $appRepo;


    /**
     * This property holds the globalDirRepo for this instance.
     * @var LpiRepositoryInterface
     */
    private $globalDirRepo;

    /**
     * This property holds the webRepo for this instance.
     * @var LpiRepositoryInterface
     */
    private $webRepo;

    /**
     * Builds the LpiRepositoryUtil instance.
     */
    public function __construct()
    {
        $this->appDir = null;
        $this->appRepo = null;
        $this->globalDirRepo = null;
        $this->webRepo = null;
    }


    /**
     * Sets the appDir.
     *
     * @param string $appDir
     */
    public function setAppDir(?string $appDir)
    {
        $this->appDir = $appDir;
    }


    /**
     * Returns an array of info for the first planet that matches the given arguments, or false if nothing matched.
     *
     * The info array contains the following:
     *
     * - repo: string, the type of repo that matched; can be one of: app, global, web.
     * - version: string, the real version that matched the description
     *
     *
     * This method tries the following techniques in order:
     *
     * - try from the app repository
     * - try from the global dir repository
     * - try from the web repository
     *
     *
     *
     * @param string $planetDot
     * @param string $versionExpression
     * @return array|false
     */
    public function getFirstMatchingInfo(string $planetDot, string $versionExpression)
    {
        $ret = false;

        if ('last' === $versionExpression) {
            goto web;
        }


        // try from the app first...
        $realVersion = LpiVersionHelper::getFirstMatchingVersionByRepository($planetDot, $versionExpression, $this->getAppRepository());
        if (false !== $realVersion) {
            $ret = [
                'repo' => 'app',
                'version' => $realVersion,
            ];
        } else {
            // ...then try from the global dir...
            $realVersion = LpiVersionHelper::getFirstMatchingVersionByRepository($planetDot, $versionExpression, $this->getGlobalDirRepository());
            if (false !== $realVersion) {
                $ret = [
                    'repo' => 'global',
                    'version' => $realVersion,
                ];
            } else {


                web:
                // ...then try from the web...
                $realVersion = LpiVersionHelper::getFirstMatchingVersionByRepository($planetDot, $versionExpression, $this->getWebRepository());
                if (false !== $realVersion) {
                    $ret = [
                        'repo' => 'web',
                        'version' => $realVersion,
                    ];
                }

            }
        }

        return $ret;
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Returns the app repository.
     * @return LpiRepositoryInterface
     */
    public function getAppRepository(): LpiRepositoryInterface
    {
        if (null === $this->appRepo) {
            $this->appRepo = new LpiApplicationRepository();
            $this->appRepo->setAppDir($this->appDir);
        }
        return $this->appRepo;
    }

    /**
     * Returns the global dir repository.
     *
     * @return LpiRepositoryInterface
     */
    public function getGlobalDirRepository(): LpiRepositoryInterface
    {
        if (null === $this->globalDirRepo) {
            $this->globalDirRepo = new LpiGlobalDirRepository();
        }
        return $this->globalDirRepo;
    }


    /**
     * Returns the web repository.
     *
     * @return LpiRepositoryInterface
     */
    public function getWebRepository(): LpiRepositoryInterface
    {
        if (null === $this->webRepo) {
            $this->webRepo = new LpiWebRepository();

        }
        return $this->webRepo;
    }


}