<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/04/16
 * Time: 04:37
 */
namespace eFrogg\ArchiveManager;
class PeriodCollection
{

    /**
     * @var ArchivePeriod[]
     */
    protected $periods;


    public function addPeriod(ArchivePeriod $period) {
        $this -> periods[]=$period;
    }

    public function keepFirst()
    {
        array_walk($this->periods,function(ArchivePeriod $period) {
            $period -> keepFirst();
        });
    }

    public function addItem(ArchiveItem $item)
    {
//        echo "<br>additem ".$item;
        $item_time = $item -> getTimestamp();
        $added = false;
        foreach($this->periods as $period) {
            if($period -> hasDate($item_time)) {
                $period->addItem($item);
                $added = true;
            }
        }
        if(!$added ) {
//            echo "not added" ;
        }
    }

    public function cleanArchives()
    {
        foreach($this->periods as $period) {
            $period -> cleanArchives();
        }
    }

    public function reset()
    {
        foreach($this->periods as $period) {
            $period -> reset();
        }
    }
}