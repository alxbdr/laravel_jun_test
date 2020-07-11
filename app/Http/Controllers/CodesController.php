<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodesController extends Controller
{
    //

    public function list() {
        return view('list');
    }

    public function create() {
        return view('create');
    }

    public function delete($id) {
        return view('delete');
    }
}
