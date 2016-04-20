<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/04/16
 * Time: 14:03
 */

namespace eFrogg\ArchiveManager\Tests;

use eFrogg\ArchiveManager\ArchiveManager;

class TestArchiveManager
{
    /**
     * @var ArchiveManager
     */
    private $manager;

    /**
     * TestArchiveManager constructor.
     * @param ArchiveManager $manager
     */
    public function __construct(ArchiveManager $manager)
    {
        $this->manager = $manager;
    }


    /**
     * TestArchiveManager constructor.
     * @param \DateTime $from_date
     * @param \DateTime $to_date
     * @param \DateInterval $interval_backup
     * @param $iterations
     * @param \DateInterval $interval_iteration
     */
    public function test(\DateTime $from_date,\DateTime $to_date,\DateInterval $interval_backup, $iterations,\DateInterval $interval_iteration)
    {
        $iterator = new TestArchiveIterator();
        $iterator -> initTest($from_date,$to_date, $interval_backup);

        $this->manager
            -> setIterator($iterator)
            -> cleanArchives();

        $iterator -> out();

        for($i = 0;$i<$iterations;$i++) {
            $iterator -> back($interval_iteration);
            $this->manager -> reset() -> cleanArchives();
            $iterator -> out();
        }

    }
}