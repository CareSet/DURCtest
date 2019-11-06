<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=9d4894b3b24b9cedeaf1e313eb30cc46
*/
namespace App\Http\Controllers;

use App\sibling;
use App\DURC\Controllers\siblingController as DURCParentController;
use Illuminate\Http\Request;

class siblingController extends DURCParentController
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
     * @param  \App\$sibling  $sibling
     * @return \Illuminate\Http\Response
     */
    public function show(sibling $sibling){
        // enter your stuff here if you want...
	return(parent::show($sibling));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\sibling  $sibling
     * @return \Illuminate\Http\Response
     */
    public function edit(sibling $sibling, $is_new = false){
        // enter your stuff here if you want...
	return(parent::edit($sibling));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sibling  $sibling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sibling $sibling){
        // enter your stuff here if you want...
	return(parent::update($request,$sibling));
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\sibling  $sibling
     * @return \Illuminate\Http\Response
     */
    public function destroy(sibling $sibling){
        // enter your stuff here if you want...
	return(parent::destroy($sibling));
    }

}
