<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;

class UsersController extends Controller
{
    public function create(){

    	return view ('infos');
    }

	public function store(ContactRequest $request) {
        return view('confirm');
    }
}
