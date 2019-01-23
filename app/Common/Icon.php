<?php

namespace App\Common;

use Illuminate\Http\Request;

class Icon {

    private $icon_color;
    private $icon_width;
    private $icon_height;
    private $icon_coef;

    /**
     * Icon constructor.
     * @param Request $request
     * @param CanvasSettings $settings
     */
    public function __construct(Request $request, CanvasSettings $settings)
    {
        $this->icon_coef = $request->input('coef') / 100;
        $this->icon_width = $settings->getButtonWidth() * $this->getIconCoef();
        $this->icon_height = $settings->getButtonHeight() * $this->getIconCoef();
        $this->icon_color = new Color($request->input('icon_color'));
    }

    /**
     * @return float
     */
    public function getIconCoef(): float
    {
        return $this->icon_coef;
    }

    /**
     * @return int
     */
    public function getIconWidth(): int
    {
        return $this->icon_width;
    }

    /**
     * @return int
     */
    public function getIconHeight(): int
    {
        return $this->icon_height;
    }

    /**
     * @return Color
     */
    public function getIconColor(): Color
    {
        return $this->icon_color;
    }

}