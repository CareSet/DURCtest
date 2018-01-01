<?php

namespace App;
/*
	salesreport: controls northwind_model.salesReport

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.

DURC Generated At: Monday 1st of January 2018 04:58:04 PM

*/
class salesreport extends \App\DURC\Models\DURC_salesreport
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'groupBy', //varchar
			//'display', //varchar
			//'title', //varchar
			//'filterRowSource', //longtext
			//'default', //tinyint
		]; //end hidden array

//DURC HAS_MANY SECTION			//DURC did not detect any has_many relationships//DURC BELONGS_TO SECTION			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end salesreport