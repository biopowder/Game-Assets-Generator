<?php

namespace App\Generator;

use App\Common\CanvasSettings;
use App\Common\Icon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ButtonGenerator {

    private $settings;
    private $icon_settings;
    private $buttons;

    /**
     * ButtonGenerator constructor.
     * @param CanvasSettings $settings
     * @param Icon $icon_settings
     */
    public function __construct(CanvasSettings $settings, Icon $icon_settings)
    {
        $this->settings = $settings;
        $this->icon_settings = $icon_settings;
        $this->collectButtons();
    }

    /**
     *
     */
    public function collectButtons()
    {
        $files = File::allFiles(base_path('buttons/icons'));
        foreach ($files as $file) {
            $this->buttons[] = $this->composeFromFile($file);
        }
    }

    /**
     * @param $file
     * @return mixed
     */
    public function composeFromFile($file)
    {
        $img = Image::canvas($this->settings->getButtonWidth(), $this->settings->getButtonHeight());

        $first = Image::make(base_path('buttons/types/' . $this->settings->getType() . '/1.png'))->resize($this->settings->getButtonWidth(), $this->settings->getButtonHeight());
        $baseColor = $this->settings->getBaseColor();
        $first->colorize($baseColor->getRed(), $baseColor->getGreen(), $baseColor->getBlue());
        $img->insert($first);

        $second = Image::make(base_path('buttons/types/' . $this->settings->getType() . '/2.png'))->resize($this->settings->getButtonWidth(), $this->settings->getButtonHeight());
        $img->insert($second);

        $third = Image::make($file)->resize($this->icon_settings->getIconWidth(), $this->icon_settings->getIconHeight());
        $iconColor = $this->icon_settings->getIconColor();
        $third->colorize($iconColor->getRed(), $iconColor->getGreen(), $iconColor->getBlue());
        $img->insert($third, 'center');

        $img->save(Storage::path('stock/' . Session::get('uid') . '/parts/' . $file->getFileName()));
        return $img;
    }

    /**
     * @return array
     */
    public function getButtons(): array
    {
        return $this->buttons;
    }

}