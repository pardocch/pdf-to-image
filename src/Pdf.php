<?php

namespace Pardocch\Convert;

use Imagick;

class Pdf
{

    protected $format = 'jpg';

    protected $validImageFormats = ['jpg', 'jpeg', 'png'];

    protected $file;

    protected $fileName;

    protected $ext;

    protected $path;

    protected $pages;

    protected $resolution = 196;

    protected $compressionQuality;

    public $imagick;

    /**
     * Pdf constructor.
     * @param $file
     * @throws \ImagickException
     */
    public function __construct($file)
    {
        $this->file = $file;
        $this->imagick = new Imagick;
    }

    /**
     * @param int $resolution
     * @return $this
     */
    public function setResolution($resolution)
    {
        $this->resolution = $resolution;

        return $this;
    }

    /**
     * @param $compressionQuality
     * @return $this
     */
    public function setCompressionQuality($compressionQuality)
    {
        $this->compressionQuality = $compressionQuality;

        return $this;
    }

    /**
     * @param $destination
     * @throws \ImagickException
     */
    public function save($destination)
    {
        if (!is_dir("{$destination}/{$this->getFileName()}")) mkdir("{$destination}/{$this->getFileName()}", 0777);
        for ($index = 0; $index < $this->getPages(); $index++) {
            $this->imagick->setResolution($this->resolution, $this->resolution);
            $this->imagick->readImage(($this->file) . '['.$index.']');
            $this->imagick->setImageFormat($this->format);
            $this->imagick->writeImage("{$destination}{$this->getFileName()}/{$index}.{$this->format}");
            $this->imagick->clear();
            $this->imagick->destroy();
        }
    }

    /**
     * @return false|int
     */
    public function getPages()
    {
        $fileContent = file_get_contents($this->file);
        $this->pages = preg_match_all("/\/Page\W/", $fileContent, $dummy);

        return $this->pages;
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setImageFormat($format='jpg')
    {
        if (!$this->isValidImageFormat($format)) {
            die("{$format} is not supported");
        }

        $this->format = $format;

        return $this;
    }

    /**
     * @return string
     */
    public function getOutputFormat()
    {
        return $this->format;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return pathinfo($this->file, PATHINFO_FILENAME);
    }

    /**
     * @return mixed
     */
    public function getFileExt()
    {
        return pathinfo($this->file, PATHINFO_EXTENSION);
    }

    /**
     * @param $format
     * @return bool
     */
    public function isValidImageFormat($format)
    {
        return in_array($format, $this->validImageFormats);
    }
}