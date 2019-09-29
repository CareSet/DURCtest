<?php

namespace App;
/*
	orderdetailstat: controls northwind_model.orderDetailStat

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class orderdetailstat extends \App\DURC\Models\orderdetailstat
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'statusName', //varchar
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end orderdetailstat