<?php

namespace App\Http\Controllers;

use App\author;
use App\DURC\Controllers\DURC_authorController;
use Illuminate\Http\Request;

//DURC Generated At: Monday 1st of January 2018 04:58:04 PM
class authorController extends DURC_authorController
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        // enter your stuff here if you want...

	//anything you put into $this->view_data will be available in the view...
	//$this->view_data['how_cool_is_fred'] = 'very'
	//will mean that you can use {{how_cool_is_fred}} etc etc..
	//remember to look in /resources/views/DURC
	//to find the DURC generated views. Once you override those views..
	//DURC will not overwrite them anymore... same thing with this file.. you can change it and it will not
	//be overwritten by subsequent files...

	return(parent::index($request));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(){
        // enter your stuff here if you want...
	return(parent::create());
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // enter your stuff here if you want...
	return(parent::store($request));
    }

    /**
     * Display the specified resource.
     * @param  \App\$author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(author $author){
        // enter your stuff here if you want...
	return(parent::show($author));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(author $author, $is_new = false){
        // enter your stuff here if you want...
	return(parent::edit($author));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, author $author){
        // enter your stuff here if you want...
	return(parent::update($request,$author));
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(author $author){
        // enter your stuff here if you want...
	return(parent::destroy($author));
    }

}
