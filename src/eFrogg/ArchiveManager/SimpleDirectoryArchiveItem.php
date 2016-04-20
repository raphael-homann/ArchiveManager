<?php

/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/04/16
 * Time: 09:21
 */

namespace eFrogg\ArchiveManager;

class SimpleDirectoryArchiveItem extends ArchiveItem
{
    protected $real_path;

    /**
     * SimpleDirectoryArchiveItem constructor.
     * @param \DateTime $date
     */
    public function __construct($date)
    {
        parent::__construct($date);
    }

    public function delete()
    {
        if(!ArchiveManager::$realMode) {
            echo "<br>[simulation] Suppression fichier ".$this->real_path;
        } else {
            unlink($this->real_path);
        }
    }

    public function setRealPath($path)
    {
        $this -> real_path = realpath($path);
    }
}