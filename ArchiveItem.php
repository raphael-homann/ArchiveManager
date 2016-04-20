<?php

/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/04/16
 * Time: 05:06
 */
class ArchiveItem
{
    /**
     * @var DateTime
     */
    private $date;

    /**
     * ArchiveItem constructor.
     * @param DateTime $date
     */
    public function __construct($date)
    {

        $this->date = $date;
    }

    public function getTimestamp()
    {
        return $this->date -> getTimestamp();
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    public function delete()
    {
        echo "<br>DELETE ".$this->date->format('Y-m-d');
    }
}