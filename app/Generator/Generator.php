<?php

namespace App\Generator;

use App\Common\AtlasSettings;
use App\Common\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Generator {

    private $atlas_settings;
    private $icon_settings;

    public function generate(Request $request)
    {
        $this->atlas_settings = new AtlasSettings($request);
        $this->icon_settings = new Icon($request, $this->atlas_settings);

        if (!file_exists(Storage::path('stock/' . Session::get('uid') . '/parts'))) {
            File::makeDirectory(Storage::path('stock/' . Session::get('uid') . '/parts'), 0755, true, true);
        }

        $button_generator = new ButtonGenerator($this->atlas_settings, $this->icon_settings);
        dd($button_generator->getButtons());
    }

}