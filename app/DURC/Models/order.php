<?php

namespace App\DURC\Models;

use CareSet\DURC\DURCModel;
/*
	Note this class was auto-generated from 

northwind_data.order by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in order.php 

*/

class order extends DURCModel{

    

    
        // the datbase for this model
        protected $table = 'northwind_data.order';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
			'invoice', //from from many
			'orderdetail', //from from many
			'employee', //from belongs to
			'customer', //from belongs to
			'shipper', //from belongs to
		];


	//DURC did not detect any date fields

	public $timestamps = false;
	//DURC NOTE: did not find updated_at and created_at fields for this model

	
	
	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'id' => 'int',
		'employee_id' => 'int',
		'customer_id' => 'int',
		'orderDate' => 'datetime',
		'shippedDate' => 'datetime',
		'shipper_id' => 'int',
		'shipName' => 'varchar',
		'shipAddress' => 'longtext',
		'shipCity' => 'varchar',
		'shipStateProvince' => 'varchar',
		'shipZipPostalCode' => 'varchar',
		'shipCountryRegion' => 'varchar',
		'shippingFee' => 'decimal',
		'taxes' => 'decimal',
		'paymentType' => 'varchar',
		'paidDate' => 'datetime',
		'notes' => 'longtext',
		'taxRate' => 'double',
		'taxStatus_id' => 'tinyint',
		'status_id' => 'tinyint',
			]; //end field_type_map
		
		// Indicate which fields are nullable
		static $non_nullable_fields = [
			]; // End of nullable fields

		// Indicate which fields are nullable
		static $default_values = [
			]; // End of default values
        
		//everything is fillable by default
		protected $guarded = [];


		
//DURC HAS_MANY SECTION

/**
*	get all the invoice for this order
*/
	public function invoice(){
		return $this->hasMany('App\invoice','order_id','id');
	}


/**
*	get all the orderdetail for this order
*/
	public function orderdetail(){
		return $this->hasMany('App\orderdetail','order_id','id');
	}


		
		
//DURC HAS_ONE SECTION

			//DURC did not detect any has_one relationships

		
//DURC BELONGS_TO SECTION

/**
*	get the single employee for this order
*/
	public function employee(){
		return $this->belongsTo('App\employee','employee_id','id');
	}


/**
*	get the single customer for this order
*/
	public function customer(){
		return $this->belongsTo('App\customer','customer_id','id');
	}


/**
*	get the single shipper for this order
*/
	public function shipper(){
		return $this->belongsTo('App\shipper','shipper_id','id');
	}



//Originating SQL Schema
/*
CREATE TABLE `northwind_data`.`order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `orderDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shippedDate` datetime DEFAULT NULL,
  `shipper_id` int(11) DEFAULT NULL,
  `shipName` varchar(50) DEFAULT NULL,
  `shipAddress` longtext,
  `shipCity` varchar(50) DEFAULT NULL,
  `shipStateProvince` varchar(50) DEFAULT NULL,
  `shipZipPostalCode` varchar(50) DEFAULT NULL,
  `shipCountryRegion` varchar(50) DEFAULT NULL,
  `shippingFee` decimal(19,4) DEFAULT '0.0000',
  `taxes` decimal(19,4) DEFAULT '0.0000',
  `paymentType` varchar(50) DEFAULT NULL,
  `paidDate` datetime DEFAULT NULL,
  `notes` longtext,
  `taxRate` double DEFAULT '0',
  `taxStatus_id` tinyint(4) DEFAULT NULL,
  `status_id` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `employee_id` (`employee_id`),
  KEY `id` (`id`),
  KEY `shipper_id` (`shipper_id`),
  KEY `taxStatus` (`taxStatus_id`),
  KEY `shipZipPostalCode` (`shipZipPostalCode`),
  KEY `fkOrderOrderStatus1` (`status_id`),
  CONSTRAINT `fkOrderCustomers` FOREIGN KEY (`customer_id`) REFERENCES `northwind_model`.`customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkOrderEmployees1` FOREIGN KEY (`employee_id`) REFERENCES `northwind_model`.`employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkOrderOrderStatus1` FOREIGN KEY (`status_id`) REFERENCES `northwind_model`.`orderStatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkOrderOrderTaxStatus1` FOREIGN KEY (`taxStatus_id`) REFERENCES `northwind_model`.`orderTaxStatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkOrderShippers1` FOREIGN KEY (`shipper_id`) REFERENCES `northwind_model`.`shipper` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=utf8
*/


}//end of order