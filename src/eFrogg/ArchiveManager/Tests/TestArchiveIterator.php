<?php

/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/04/16
 * Time: 12:23
 */
namespace eFrogg\ArchiveManager\Tests;

use eFrogg\ArchiveManager\ArchiveIterator;

class TestArchiveIterator extends ArchiveIterator

{

    /** @var array TestIterator */
    protected $items = [];
    protected $nb_jours;

    /**
     * @return TestArchiveItem[]
     */
    public function getArchiveItems()
    {
        return array_filter($this->items,function(TestArchiveItem $item) {
            return !$item -> isDeleted();
        });
    }

    public function initTest(\DateTime $from_date,\DateTime $to_date,\DateInterval $interval ) {
        $this -> nb_jours = date_diff($to_date,$from_date)->days;

        while($from_date -> getTimestamp() < $to_date -> getTimestamp()) {
            $this->items[] = new TestArchiveItem(clone($from_date));
            $from_date -> add($interval);
        }
    }

    public function back(\DateInterval $interval) {
        array_walk($this->items,function(TestArchiveItem $item) use ($interval) {
            $item -> getDate() -> sub($interval);
        });

    }

    private $outed = false;
    public function out() {
        if(!$this->outed) {
            $this->outed = true;
            echo "<style>
                .year{
                    width:".($this->nb_jours*3)."px;
                    margin: 0 auto;
                    border: solid 1px #CCC;
                    height:3px;
                    position: relative;
                    border-bottom:none;
                }
                .day {
                    width:2px;
                    position:absolute;
                    height:3px;
                    background:red;
                    border-left:solid 1px black;
                }
        </style>";
        }
        echo "<div class='year'>";
        $now = new \DateTime();
        foreach($this -> getArchiveItems() as $k => $item) {
            if($item -> getDate()->getTimestamp()<$now->getTimestamp()) {
                $ratio = 100-(100*date_diff($now,$item -> getDate()) -> days / $this->nb_jours);
                echo "<div class='day' style='left:$ratio%'></div>";
            }
        }
        echo "</div>";
    }
}