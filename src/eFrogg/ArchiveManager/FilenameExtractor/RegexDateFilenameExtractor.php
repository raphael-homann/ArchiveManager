<?php
namespace eFrogg\ArchiveManager\FilenameExtractor;

class RegexDateFilenameExtractor implements DateFilenameExtractor {
    protected $regex = null;
    public function __construct($regex) {
        $this->regex = $regex;
    }

    public function extractDateFromFilename($filename)
    {
        $extracted_date = null;
        if(preg_match($this->regex,$filename,$match)) {
            $extracted_date = $match[1];

            $extracted_date = new \DateTime($extracted_date);
        }
        return $extracted_date;
    }
}