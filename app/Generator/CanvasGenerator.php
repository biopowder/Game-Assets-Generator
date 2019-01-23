<?php

namespace App\Generator;


use Intervention\Image\Facades\Image as ImageFacade;
use Intervention\Image\Image;

class CanvasGenerator {

    private $width;
    private $height;
    private $canvas;
    private $padding;
    private $canvas_settings;
    private $buttons;

    /**
     * CanvasGenerator constructor.
     * @param $buttons
     * @param $canvas_settings
     * @internal param $width
     * @internal param $height
     * @internal param $padding
     */
    public function __construct($buttons, $canvas_settings)
    {
        $this->buttons = $buttons;

        $button_count = (int)ceil(sqrt(count($buttons)));
        $this->canvas_settings = $canvas_settings;

        $this->padding = $canvas_settings->getPadding();

        $this->width = $this->canvas_settings->getButtonWidth() * $button_count + $this->padding * ($button_count + 1);
        $this->height = $this->width;

        $this->canvas = ImageFacade::canvas($this->width, $this->height);
    }

    /**
     * @return Image
     * @internal param $buttons
     */
    public function placeButtons(): Image
    {
        $current_width = $this->padding;
        $current_height = $this->padding;
        $button_width = $this->canvas_settings->getButtonWidth();

        foreach ($this->buttons as $button) {
            $this->canvas->insert($button, "top-left", $current_width, $current_height);
            if ($current_width >= $this->width - $button_width - $this->padding * 2) {
                $current_width = $this->padding;
                $current_height += $this->canvas_settings->getButtonHeight() + $this->padding;
            } else {
                $current_width += $button_width + $this->padding;
            }
        }
        return $this->canvas;
    }

}