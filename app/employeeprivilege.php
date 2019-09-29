<?php

namespace App;
/*
	employeeprivilege: controls northwind_model.employeePrivilege

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class employeeprivilege extends \App\DURC\Models\employeeprivilege
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'employee', //from belongs to
			'privilege', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'employee_id', //int
			//'privilege_id', //int
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the employee for this employeeprivilege in employeeprivilege
*       but you can extend or override the defaults by editing this function...
*/
	public function employee(){
		return parent::employee();
	}


/**
*	DURC is handling the privilege for this employeeprivilege in employeeprivilege
*       but you can extend or override the defaults by editing this function...
*/
	public function privilege(){
		return parent::privilege();
	}


	//your stuff goes here..
	

}//end employeeprivilege