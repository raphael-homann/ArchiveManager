<?php
namespace eFrogg\ArchiveManager;
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/04/16
 * Time: 05:06
 */
abstract class ArchiveItem
{
    /**
     * @var \DateTime
     */
    private $date;

    /**
     * ArchiveItem constructor.
     * @param \DateTime $date
     */
    public function __construct($date)
    {

        $this->date = $date;
    }

    public function __toString()
    {
        return "[item : ".$this->date->format('d/m/Y')."]";
    }

    public function getTimestamp()
    {
        return $this->date -> getTimestamp();
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    abstract public function delete();
}