<?php

namespace App\Common;

use Illuminate\Http\Request;

class Icon {

    public function __construct(Request $request, AtlasSettings $settings)
    {
        $this->icon_coef = $request->input('coef') / 100;
        $this->icon_width = $settings->getButtonWidth() * $this->getIconCoef();
        $this->icon_height = $settings->getButtonHeight() * $this->getIconCoef();
        $this->icon_color = new Color($request->input('icon_color'));
    }

    public function getIconCoef(): float
    {
        return $this->icon_coef;
    }

    public function getIconWidth(): int
    {
        return $this->icon_width;
    }

    public function getIconHeight(): int
    {
        return $this->icon_height;
    }

    public function getIconColor(): Color
    {
        return $this->icon_color;
    }

    private $icon_color;
    private $icon_width;
    private $icon_height;
    private $icon_coef;

}