<?php

class SimpleDirectoryIterator extends ArchiveIterator {
    protected $path=null;
    protected $regex;

    public function __construct()
    {

    }

    /**
     * @param string $path
     * @param $regex
     * @return SimpleDirectoryIterator
     */
    public function setPath($path,$regex)
    {
        $this->path = $path;
        $this -> regex = $regex;
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
                if(preg_match($this->regex,$file_name,$match)) {
    //                var_dump($file_name);
                    $date = new DateTime($match[1]);
                    $items[] = new ArchiveItem($date);
                }
            }
        }
        return $items;
    }

}