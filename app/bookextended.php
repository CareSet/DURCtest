<?php

namespace App;
/*
	bookextended: controls aaaDurctest.bookextended

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class bookextended extends \App\DURC\Models\bookextended
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'book', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'book_id', //int
			//'ISBN', //varchar
			//'local_isle', //varchar
			//'local_shelf', //int
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the book for this bookextended in bookextended
*       but you can extend or override the defaults by editing this function...
*/
	public function book(){
		return parent::book();
	}


	//your stuff goes here..
	

}//end bookextended