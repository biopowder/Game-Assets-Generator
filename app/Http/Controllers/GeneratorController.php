<?php

namespace App\Http\Controllers;

use App\Generator\Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class GeneratorController extends Controller {

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(Request $request)
    {
        (new Generator())->generate($request);
        return Redirect::back()->withInput(Input::all());
    }

}



