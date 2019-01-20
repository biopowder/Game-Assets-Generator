<?php

namespace App\Common;

class Color {

    /**
     * Color constructor.
     * @param $hex
     */
    public function __construct($hex)
    {
        $this->hexTo100($hex);
    }

    /**
     * @return mixed
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * @return mixed
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * @return mixed
     */
    public function getBlue()
    {
        return $this->blue;
    }

    private $red;
    private $green;
    private $blue;

    private function hexTo100($hex)
    {
        $this->red = round((hexdec(substr($hex, 1, 2)) * 100) / 255) - 100;
        $this->green = round((hexdec(substr($hex, 3, 2)) * 100) / 255) - 100;
        $this->blue = round((hexdec(substr($hex, 5, 2)) * 100) / 255) - 100;
    }

}