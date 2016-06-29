<?php

namespace eFrogg\ArchiveManager;

use eFrogg\ArchiveManager\FilenameExtractor\DateFilenameExtractor;

class SimpleDirectoryIterator extends ArchiveIterator {
    protected $path=null;
    protected $filename_date_extractor;

    public function __construct(DateFilenameExtractor $filename_date_extractor)
    {
        $this->filename_date_extractor = $filename_date_extractor;
    }

    /**
     * @param string $path
     * @param $regex
     * @return SimpleDirectoryIterator
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return ArchiveItem[]
     */
    public function getArchiveItems() {
        $items = array();
        //TODO : directoryIterator
        if($dir = opendir($this->path)) {
            while($file_name = readdir($dir)) {
                if($file_name != "." && $file_name != "..") {
                    $date = $this->filename_date_extractor->extractDateFromFilename($file_name);
                    if(!empty($date)) {
                        $item = new SimpleDirectoryArchiveItem($date);
                        $item -> setRealPath($this->path."/".$file_name);
                        $items[] = $item;
                    }
                }
            }
        }
        array_walk($items,function(ArchiveItem $item){
            $item -> setSimulate($this -> simulate);
        });
        return $items;
    }

}