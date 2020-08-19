<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
    	$title = 'This is the HomePage';
    	// return view('pages.index', compact('title'));
    	return view('pages.index')->with('title', $title);
    }

    public function about() {
    	return view('pages.about');
    }

    public function services() 
{
    	$data = array(
    		'title'			=>		'Services',
    		'description'	=>		'This is just a simple description',
    		'list'			=>		['Control', 'Model', 'View'],
    	);

    	return view('pages.services')->with($data);
    }

}