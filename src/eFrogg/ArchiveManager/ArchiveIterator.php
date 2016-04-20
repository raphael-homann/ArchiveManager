<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/04/16
 * Time: 04:23
 */
namespace eFrogg\ArchiveManager;
abstract class ArchiveIterator {

    /**
     * @return ArchiveItem[]
     */
    abstract public function getArchiveItems();

}