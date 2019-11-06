<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=0c2c3c2a8c6e862c6e3c91305180acd0
*/
namespace App\Http\Controllers;

use App\tags_report;
use App\DURC\Controllers\tags_reportController as DURCParentController;
use Illuminate\Http\Request;

class tags_reportController extends DURCParentController
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
     * @param  \App\$tags_report  $tags_report
     * @return \Illuminate\Http\Response
     */
    public function show(tags_report $tags_report){
        // enter your stuff here if you want...
	return(parent::show($tags_report));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\tags_report  $tags_report
     * @return \Illuminate\Http\Response
     */
    public function edit(tags_report $tags_report, $is_new = false){
        // enter your stuff here if you want...
	return(parent::edit($tags_report));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tags_report  $tags_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tags_report $tags_report){
        // enter your stuff here if you want...
	return(parent::update($request,$tags_report));
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\tags_report  $tags_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(tags_report $tags_report){
        // enter your stuff here if you want...
	return(parent::destroy($tags_report));
    }

}
