<?php

namespace App;
/*
	test_soft_delete: controls aaaDurctest.test_soft_delete

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class test_soft_delete extends \App\DURC\Models\test_soft_delete
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'label', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
			//'deleted_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end test_soft_delete