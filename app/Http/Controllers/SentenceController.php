<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SentenceController extends Controller
{
    public function index() {
        return view('sentences.welcome');
    }

    public function create() {
        return view('sentences.create');
    }

    public function store(Request $request) {
        return view('sentence.store');
    }
}
