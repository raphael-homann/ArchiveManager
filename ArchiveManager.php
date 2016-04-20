<?php

class ArchiveManager {

    /** @var  PeriodCollection */
    public $periods;

    public $min_timestamp = null;

    /** @var  ArchiveIterator */
    protected $iterator;

    /**
     * ArchiveManager constructor.
     * @param ArchivePeriod[] $periods
     */
    public function __construct()
    {
        $this->periods = new PeriodCollection();
    }


    public function addPeriod(ArchivePeriod $period,$autoEnd = true)
    {
        $this -> periods -> addPeriod($period);
        if($autoEnd) {
            $period->setEndTimestamp($this->getMinTimestamp());
        }
        if(is_null($this->min_timestamp) || $period -> getStartTimestamp()<$this->min_timestamp) {
            $this->min_timestamp = $period -> getStartTimestamp();
        }
        return $period;
    }

    /**
     * @return int timestamp
     */
    public function getMinTimestamp()
    {
        if(is_null($this->min_timestamp)) {
            $now = new DateTime();
            return $now->getTimestamp();
        }
        return $this->min_timestamp;
    }



    public function setIterator(ArchiveIterator $iterator)
    {
        $this -> iterator = $iterator;
    }

    public function run()
    {
        foreach($this -> iterator -> getArchiveItems() as $item) {
            $this -> addItem($item);
        }
        echo "run";
    }


    private function addItem(ArchiveItem $item)
    {
        $this->periods -> addItem($item);
    }

}