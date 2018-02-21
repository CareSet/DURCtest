<?php

namespace App;
/*
	book: controls aaaDurctest.book

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class book extends \App\DURC\Models\book
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
			//'title', //varchar
			//'release_date', //datetime
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the author_book for this book in book
*       but you can extend or override the defaults by editing this function...
*/
	public function author_book(){
		return parent::author_book();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end book