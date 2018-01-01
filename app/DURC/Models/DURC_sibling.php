<?php

namespace App\DURC\Models;

use CareSet\DURC\DURCModel;
/*
	Note this class was auto-generated from 

aaaDurctest.sibling by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in sibling.php 

DURC Generated At: Monday 1st of January 2018 04:58:04 PM
*/

class DURC_sibling extends DURCModel{

        // the datbase for this model
        protected $table = 'aaaDurctest.sibling';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
			'step_sibling', //from belongs to
			'sibling', //from belongs to
		];


	//DURC did not detect any date fields

	public $timestamps = false;
	//DURC NOTE: did not find updated_at and created_at fields for this model

	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'id' => 'int',
		'siblingname' => 'varchar',
		'step_sibling_id' => 'int',
		'sibling_id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
			]; //end field_type_map

		//everything is fillable by default
		protected $guarded = [];


		//DURC HAS_MANY SECTION
/**
*	get all the step_sibling for this DURC_sibling
*/
	public function step_sibling(){
		return $this->hasMany('App\sibling','step_sibling_id','id');
	}


/**
*	get all the sibling for this DURC_sibling
*/
	public function sibling(){
		return $this->hasMany('App\sibling','sibling_id','id');
	}



		//DURC BELONGS_TO SECTION
/**
*	get the single step_sibling for this DURC_sibling
*/
	public function step_sibling(){
		return $this->belongsTo('App\sibling','step_sibling_id','id');
	}


/**
*	get the single sibling for this DURC_sibling
*/
	public function sibling(){
		return $this->belongsTo('App\sibling','sibling_id','id');
	}



}//end of DURC_sibling