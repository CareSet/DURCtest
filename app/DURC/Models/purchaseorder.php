<?php

namespace App\DURC\Models;

use CareSet\DURC\DURCModel;
/*
	Note this class was auto-generated from 

northwind_data.purchaseOrder by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in purchaseorder.php 

*/

class purchaseorder extends DURCModel{

    
        // the datbase for this model
        protected $table = 'northwind_data.purchaseOrder';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
			'inventorytransaction', //from from many
			'orderdetail', //from from many
			'purchaseorderdetail', //from from many
			'supplier', //from belongs to
			'createdBy_employee', //from belongs to
			'approvedBy_employee', //from belongs to
			'submittedBy_employee', //from belongs to
		];


	//DURC did not detect any date fields

	public $timestamps = false;
	//DURC NOTE: did not find updated_at and created_at fields for this model

	
	
	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'id' => 'int',
		'supplier_id' => 'int',
		'createdBy_employee_id' => 'int',
		'submittedDate' => 'datetime',
		'creationDate' => 'datetime',
		'status_id' => 'int',
		'expectedDate' => 'datetime',
		'shippingFee' => 'decimal',
		'taxes' => 'decimal',
		'paymentDate' => 'datetime',
		'paymentAmount' => 'decimal',
		'paymentMethod' => 'varchar',
		'notes' => 'longtext',
		'approvedBy_employee_id' => 'int',
		'approvedDate' => 'datetime',
		'submittedBy_employee_id' => 'int',
			]; //end field_type_map

		//everything is fillable by default
		protected $guarded = [];


		
//DURC HAS_MANY SECTION

/**
*	get all the inventorytransaction for this purchaseorder
*/
	public function inventorytransaction(){
		return $this->hasMany('App\inventorytransaction','purchaseOrder_id','id');
	}


/**
*	get all the orderdetail for this purchaseorder
*/
	public function orderdetail(){
		return $this->hasMany('App\orderdetail','PurchaseOrder_id','id');
	}


/**
*	get all the purchaseorderdetail for this purchaseorder
*/
	public function purchaseorderdetail(){
		return $this->hasMany('App\purchaseorderdetail','purchaseOrder_id','id');
	}



		
//DURC BELONGS_TO SECTION

/**
*	get the single supplier for this purchaseorder
*/
	public function supplier(){
		return $this->belongsTo('App\supplier','supplier_id','id');
	}


/**
*	get the single createdBy_employee for this purchaseorder
*/
	public function createdBy_employee(){
		return $this->belongsTo('App\employee','createdBy_employee_id','id');
	}


/**
*	get the single approvedBy_employee for this purchaseorder
*/
	public function approvedBy_employee(){
		return $this->belongsTo('App\employee','approvedBy_employee_id','id');
	}


/**
*	get the single submittedBy_employee for this purchaseorder
*/
	public function submittedBy_employee(){
		return $this->belongsTo('App\employee','submittedBy_employee_id','id');
	}



}//end of purchaseorder