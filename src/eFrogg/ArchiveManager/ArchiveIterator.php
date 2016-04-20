<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/04/16
 * Time: 04:23
 */
namespace eFrogg\ArchiveManager;
abstract class ArchiveIterator {

    protected $simulate = false;
    /**
     * @return ArchiveItem[]
     */
    abstract public function getArchiveItems();

    /**
     * @param boolean $simulate
     * @return ArchiveIterator
     */
    public function setSimulate($simulate)
    {
        $this->simulate = $simulate;
        return $this;
    }

}