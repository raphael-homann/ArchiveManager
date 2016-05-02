<?php
namespace eFrogg\ArchiveManager\FilenameExtractor;

interface DateFilenameExtractor {
    public function extractDateFromFilename($filename);
}