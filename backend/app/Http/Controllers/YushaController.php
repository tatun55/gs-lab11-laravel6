<?php

namespace App\Http\Controllers;

use App\Yoroi;
use Illuminate\Http\Request;

class YushaController extends Controller
{
    public function aaaa()
    {
        return 'ああああ';
    }

    public function iiii()
    {
        return view('iiii');
    }

    public function uuuu()
    {
        $yoroi = Yoroi::find(1);
        return view('uuuu', [
            'yoroi' => $yoroi
        ]);
    }
}