<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
	const SALUT = 'Bonjour';

    public function index($n=1)
    {
		$a = self::SALUT;
        return view('front.welcome', ['n'=>$n, 'a'=>$a]);
    }
}
