<?php

namespace App\DURC\Models;

use CareSet\DURC\DURCModel;
/*
	Note this class was auto-generated from 

northwind_data.inventoryTransaction by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in inventorytransaction.php 

*/

class inventorytransaction extends DURCModel{

    
        // the datbase for this model
        protected $table = 'northwind_data.inventoryTransaction';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
			'product', //from belongs to
			'purchaseorder', //from belongs to
		];


	//DURC did not detect any date fields

	public $timestamps = false;
	//DURC NOTE: did not find updated_at and created_at fields for this model

	
	
	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'id' => 'int',
		'transactionType' => 'tinyint',
		'transactionCreatedDate' => 'datetime',
		'transactionModifiedDate' => 'datetime',
		'product_id' => 'int',
		'quantity' => 'int',
		'purchaseOrder_id' => 'int',
		'customerOrder_id' => 'int',
		'comments' => 'varchar',
			]; //end field_type_map

		//everything is fillable by default
		protected $guarded = [];


		
//DURC HAS_MANY SECTION

			//DURC did not detect any has_many relationships

		
//DURC BELONGS_TO SECTION

/**
*	get the single product for this inventorytransaction
*/
	public function product(){
		return $this->belongsTo('App\product','product_id','id');
	}


/**
*	get the single purchaseorder for this inventorytransaction
*/
	public function purchaseorder(){
		return $this->belongsTo('App\purchaseorder','purchaseOrder_id','id');
	}



}//end of inventorytransaction