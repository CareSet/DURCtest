<?php

namespace App\DURC\Models;

use CareSet\DURC\DURCModel;
/*
	Note this class was auto-generated from 

aaaDurctest.author by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in author.php 

DURC Generated At: Monday 1st of January 2018 04:58:04 PM
*/

class DURC_author extends DURCModel{

        // the datbase for this model
        protected $table = 'aaaDurctest.author';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
			'author_book', //from from many
		];


	//DURC did not detect any date fields

	public $timestamps = false;
	//DURC NOTE: did not find updated_at and created_at fields for this model

	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'id' => 'int',
		'lastname' => 'varchar',
		'firstname' => 'varchar',
		'select_name' => 'varchar',
		'created_date' => 'datetime',
		'updated_date' => 'datetime',
			]; //end field_type_map

		//everything is fillable by default
		protected $guarded = [];


		//DURC HAS_MANY SECTION
/**
*	get all the author_book for this DURC_author
*/
	public function author_book(){
		return $this->hasMany('App\author_book','author_id','id');
	}



		//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships

}//end of DURC_author