<?php

namespace App\DURC\Models;

use CareSet\DURC\DURCModel;
/*
	Note this class was auto-generated from 

northwind_model.product by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in product.php 

*/

class product extends DURCModel{

    
        // the datbase for this model
        protected $table = 'northwind_model.product';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
			'inventorytransaction', //from from many
			'orderdetail', //from from many
			'purchaseorderdetail', //from from many
		];


	//DURC did not detect any date fields

	public $timestamps = false;
	//DURC NOTE: did not find updated_at and created_at fields for this model

	
	
	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'supplier_ids' => 'longtext',
		'id' => 'int',
		'productCode' => 'varchar',
		'productName' => 'varchar',
		'description' => 'longtext',
		'standardCost' => 'decimal',
		'listPrice' => 'decimal',
		'reorderLevel' => 'int',
		'targetLevel' => 'int',
		'quantityPerUnit' => 'varchar',
		'discontinued' => 'tinyint',
		'minimumReorderQuantity' => 'int',
		'category' => 'varchar',
		'attachments' => 'longblob',
			]; //end field_type_map

		//everything is fillable by default
		protected $guarded = [];


		
//DURC HAS_MANY SECTION

/**
*	get all the inventorytransaction for this product
*/
	public function inventorytransaction(){
		return $this->hasMany('App\inventorytransaction','product_id','id');
	}


/**
*	get all the orderdetail for this product
*/
	public function orderdetail(){
		return $this->hasMany('App\orderdetail','product_id','id');
	}


/**
*	get all the purchaseorderdetail for this product
*/
	public function purchaseorderdetail(){
		return $this->hasMany('App\purchaseorderdetail','product_id','id');
	}



		
//DURC BELONGS_TO SECTION

			//DURC did not detect any belongs_to relationships

}//end of product