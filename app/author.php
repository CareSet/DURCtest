<?php

namespace App;
/*
	author: controls aaaDurctest.author

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class author extends \App\DURC\Models\author
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'author_book', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'lastname', //varchar
			//'firstname', //varchar
			//'created_date', //datetime
			//'updated_date', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the author_book for this author in author
*       but you can extend or override the defaults by editing this function...
*/
	public function author_book(){
		return parent::author_book();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end author