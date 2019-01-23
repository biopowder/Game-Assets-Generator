<?php

namespace App\Common;

use Illuminate\Http\Request;

class CanvasSettings {

    private $button_width;
    private $button_height;
    private $padding;
    private $type;
    private $base_color;

    /**
     * CanvasSettings constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->button_width = $request->input('width');
        $this->button_height = $request->input('height');
        $this->base_color = new Color($request->input('base_color'));
        $this->padding = $request->input('padding');
        $this->type = $request->input('type');
    }

    /**
     * @return int
     */
    public function getButtonWidth(): int
    {
        return $this->button_width;
    }

    /**
     * @return int
     */
    public function getButtonHeight(): int
    {
        return $this->button_height;
    }

    /**
     * @return int
     */
    public function getPadding(): int
    {
        return $this->padding;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return Color
     */
    public function getBaseColor(): Color
    {
        return $this->base_color;
    }


}