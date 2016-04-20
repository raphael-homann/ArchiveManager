<?php

/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/04/16
 * Time: 04:37
 */
class PeriodCollection
{

    /**
     * @var ArchivePeriod[]
     */
    protected $periods;


    /**
     * PeriodCollection constructor.
     * @param int $start_timestamp
     * @param $segments
     */
    public function __construct()
    {
    }

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
        echo "<br>additem ".$item -> getTimestamp();
        $item_time = $item -> getTimestamp();
        foreach($this->periods as $period) {
            if($period -> hasDate($item_time)) {
                $period->addItem($item);
            }
        }
    }

    public function cleanArchives()
    {
        foreach($this->periods as $period) {
            $period -> cleanArchives();
        }
    }
}