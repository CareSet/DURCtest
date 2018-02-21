<?php

namespace App\DURC\Models;

use CareSet\DURC\DURCModel;
/*
	Note this class was auto-generated from 

northwind_model.shipper by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in shipper.php 

*/

class shipper extends DURCModel{

        // the datbase for this model
        protected $table = 'northwind_model.shipper';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
			'order', //from from many
		];


	//DURC did not detect any date fields

	public $timestamps = false;
	//DURC NOTE: did not find updated_at and created_at fields for this model

	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'id' => 'int',
		'company' => 'varchar',
		'lastName' => 'varchar',
		'firstName' => 'varchar',
		'emailAddress' => 'varchar',
		'jobTitle' => 'varchar',
		'businessPhone' => 'varchar',
		'homePhone' => 'varchar',
		'mobilePhone' => 'varchar',
		'faxNumber' => 'varchar',
		'address' => 'longtext',
		'city' => 'varchar',
		'stateProvince' => 'varchar',
		'zipPostalCode' => 'varchar',
		'countryRegion' => 'varchar',
		'webPage' => 'longtext',
		'notes' => 'longtext',
		'attachments' => 'longblob',
			]; //end field_type_map

		//everything is fillable by default
		protected $guarded = [];


		
//DURC HAS_MANY SECTION

/**
*	get all the order for this shipper
*/
	public function order(){
		return $this->hasMany('App\order','shipper_id','id');
	}



		
//DURC BELONGS_TO SECTION

			//DURC did not detect any belongs_to relationships

}//end of shipper