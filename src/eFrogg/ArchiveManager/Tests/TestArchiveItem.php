<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/04/16
 * Time: 12:25
 */

namespace eFrogg\ArchiveManager\Tests;


use eFrogg\ArchiveManager\ArchiveItem;

class TestArchiveItem extends ArchiveItem
{

    protected $deleted = false;

    public function delete()
    {
        $this -> deleted = true;
    }

    /**
     * @return boolean
     */
    public function isDeleted()
    {
        return $this->deleted;
    }
}