<?php

namespace App\DURC\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use CareSet\DURC\DURCModel;
/*
	Note this class was auto-generated from 

aaaDurctest.test_soft_delete by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in test_soft_delete.php 

*/

class test_soft_delete extends DURCModel{

    use SoftDeletes;

        // the datbase for this model
        protected $table = 'aaaDurctest.test_soft_delete';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
		];


	//DURC did not detect any date fields

	public $timestamps = true;
	const UPDATED_AT = 'updated_at';
	const CREATED_AT = 'created_at';
	
	protected $dates = ['deleted_at'];


	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'id' => 'int',
		'label' => 'varchar',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
		'deleted_at' => 'datetime',
			]; //end field_type_map

		//everything is fillable by default
		protected $guarded = [];


		
//DURC HAS_MANY SECTION

			//DURC did not detect any has_many relationships

		
//DURC BELONGS_TO SECTION

			//DURC did not detect any belongs_to relationships

}//end of test_soft_delete