<?php

namespace App\DURC\Models;

use CareSet\DURC\DURCModel;
/*
	Note this class was auto-generated from 

aaaDurctest.author_book by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in author_book.php 

*/

class author_book extends DURCModel{

    
        // the datbase for this model
        protected $table = 'aaaDurctest.author_book';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
			'author', //from belongs to
			'book', //from belongs to
			'authortype', //from belongs to
		];


	//DURC did not detect any date fields

	public $timestamps = false;
	//DURC NOTE: did not find updated_at and created_at fields for this model

	
	
	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'id' => 'int',
		'author_id' => 'int',
		'book_id' => 'int',
		'authortype_id' => 'int',
			]; //end field_type_map

		//everything is fillable by default
		protected $guarded = [];


		
//DURC HAS_MANY SECTION

			//DURC did not detect any has_many relationships

		
//DURC BELONGS_TO SECTION

/**
*	get the single author for this author_book
*/
	public function author(){
		return $this->belongsTo('App\author','author_id','id');
	}


/**
*	get the single book for this author_book
*/
	public function book(){
		return $this->belongsTo('App\book','book_id','id');
	}


/**
*	get the single authortype for this author_book
*/
	public function authortype(){
		return $this->belongsTo('App\authortype','authortype_id','id');
	}



}//end of author_book