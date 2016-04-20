<?php
namespace eFrogg\ArchiveManager;
class ArchiveManager {

    /** @var  PeriodCollection */
    public $periods;

    /** @var \DateTime */
    public $min_date = null;

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
        if(is_null($this->min_date) || $period -> getStartTimestamp()<$this->min_date->getTimestamp()) {
            $this->min_date = $period -> getStartDate();
        }
        return $period;
    }

    /**
     * @return int timestamp
     */
    public function getMinTimestamp()
    {
        if(is_null($this->min_date)) {
            $this->min_date = new \DateTime();
        }
        return $this->min_date -> getTimestamp();
    }


    /**
     * @param ArchiveIterator $iterator
     * @return $this
     */
    public function setIterator(ArchiveIterator $iterator)
    {
        $this -> iterator = $iterator;
        return $this;
    }

    public function cleanArchives()
    {
        foreach($this -> iterator -> getArchiveItems() as $k => $item) {
            $this -> addItem($item);
        }
        $this->periods -> cleanArchives();
    }


    private function addItem(ArchiveItem $item)
    {
        $this->periods -> addItem($item);
    }

    public function reset()
    {
        $this->periods -> reset();
        return $this;
    }

}