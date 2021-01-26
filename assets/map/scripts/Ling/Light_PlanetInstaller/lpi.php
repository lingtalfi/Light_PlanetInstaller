<?php


//--------------------------------------------
// Welcome to the Light_PluginInstaller CLI
//--------------------------------------------
use Ling\CliTools\Input\CommandLineInput;
use Ling\CliTools\Output\Output;
use Ling\Light_PlanetInstaller\CliTools\Program\LightPlanetInstallerApplication;

require_once __DIR__ . "/../Light/app.init.inc.php";





$input = new CommandLineInput();
$output = new Output();



$app = new LightPlanetInstallerApplication();
$app->setContainer($container);
$app->run($input, $output);


