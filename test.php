<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/04/16
 * Time: 04:22
 */
use eFrogg\ArchiveManager\ArchiveManager;
use eFrogg\ArchiveManager\ArchivePeriod;
use eFrogg\ArchiveManager\SimpleDirectoryIterator;

ini_set("display_errors","on");

require_once __DIR__."/vendor/autoload.php";

$iterator = new SimpleDirectoryIterator();
$iterator -> setPath(__DIR__."/test","/^([0-9]{4}-[0-9]{2}-[0-9]{2}).*$/");

$manager = new ArchiveManager();
$manager -> realMode = true;
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 week"))) -> keepAll();
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 month"))) -> segmentBy(new DateInterval("P1W")) -> keepFirst();
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 year"))) -> segmentBy(new DateInterval("P1M")) -> keepFirst();
$manager -> addPeriod(new ArchivePeriod(new DateTime("-2 year"))) -> keepFirst();
$manager
    -> setIterator($iterator)
    -> cleanArchives();