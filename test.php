<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/04/16
 * Time: 04:22
 */

//todo : autoload
require_once __DIR__.'/ArchiveIterator.php';
require_once __DIR__.'/ArchiveItem.php';
require_once __DIR__.'/SimpleDirectoryIterator.php';
require_once __DIR__.'/ArchiveManager.php';
require_once __DIR__.'/ArchivePeriod.php';
require_once __DIR__.'/PeriodCollection.php';

$iterator = new SimpleDirectoryIterator();
$iterator -> setPath(__DIR__."/test","/^([0-9]{4}-[0-9]{2}-[0-9]{2}).*$/");

$manager = new ArchiveManager();
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 week"))) -> keepAll();
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 month"))) -> segmentBy(new DateInterval("P1W")) -> keepFirst();
$manager -> addPeriod(new ArchivePeriod(new DateTime("-1 year"))) -> segmentBy(new DateInterval("P1M")) -> keepFirst();
$manager -> setIterator($iterator);

$manager -> run();