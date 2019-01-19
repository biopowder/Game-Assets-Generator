<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class GeneratorController extends Controller {

    public function index() {
        if (!Session::has('uid')) {
            Session::put('uid', uniqid());
        }
        $data['result'] = null;
        if (Session::has('uid')) {
            if (file_exists(public_path('storage/' . Session::get('uid') . '.png'))) {
                $data['result'] = asset('storage/' . Session::get('uid') . '.png');
            }
        }
        $directories = array_map('basename', File::directories(base_path('buttons/types')));
        $data['types'] = array_combine($directories, $directories);
        return view('generator', $data);
    }

    public function process(Request $request) {
        dd($request->all());
    }

}



