<?php

namespace App\Generator;

use App\Common\CanvasSettings;
use App\Common\Icon;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Generator {

    private $canvas_settings;
    private $icon_settings;

    /**
     * @param Request $request
     */
    public function generate(Request $request)
    {
        $this->canvas_settings = new CanvasSettings($request);
        $this->icon_settings = new Icon($request, $this->canvas_settings);

        if (!file_exists(Storage::path('stock/' . Session::get('uid') . '/parts'))) {
            File::makeDirectory(Storage::path('stock/' . Session::get('uid') . '/parts'), 0755, true, true);
        }

        $button_generator = new ButtonGenerator($this->canvas_settings, $this->icon_settings);
        $buttons = $button_generator->getButtons();

        $canvas_generator = new CanvasGenerator($buttons, $this->canvas_settings);
        $canvas = $canvas_generator->placeButtons();

        $canvas->save(Storage::path('stock/' . Session::get('uid') . '/set.png'));
//        File::delete('stock/' . Session::get('uid') . '/set.png');
        $canvas->resize(300, null, function ($constraint)
        {
            $constraint->aspectRatio();
        })->save(Storage::path('public/' . Session::get('uid') . '.png'));

        $files = glob(Storage::path('stock/' . Session::get('uid') . '/parts') . '/*');
        Zipper::make(Storage::path('stock/' . Session::get('uid') . '.zip'))->add($files)->close();
        File::deleteDirectory(Storage::path('stock/' . Session::get('uid')));

    }

}