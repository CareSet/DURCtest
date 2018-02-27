<?php

namespace App\DURC\Models;

use CareSet\DURC\DURCModel;
/*
	Note this class was auto-generated from 

aaaDurctest.funnything by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in funnything.php 

*/

class funnything extends DURCModel{

    
        // the datbase for this model
        protected $table = 'aaaDurctest.funnything';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
		];


	//DURC did not detect any date fields

	public $timestamps = false;
	//DURC NOTE: did not find updated_at and created_at fields for this model

	
	
	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'id' => 'int',
		'thisint' => 'int',
		'thisfloat' => 'float',
		'thisdecimal' => 'decimal',
		'thisvarchar' => 'varchar',
		'thisdate' => 'date',
		'thisdatetime' => 'datetime',
		'thistimestamp' => 'timestamp',
		'thischar' => 'char',
		'thistext' => 'text',
		'thisblob' => 'blob',
		'thistinyint' => 'tinyint',
		'thistinytext' => 'tinytext',
			]; //end field_type_map

		//everything is fillable by default
		protected $guarded = [];


		
//DURC HAS_MANY SECTION

			//DURC did not detect any has_many relationships

		
//DURC BELONGS_TO SECTION

			//DURC did not detect any belongs_to relationships

}//end of funnything