<?php

namespace App;
/*
	author_book: controls aaaDurctest.author_book

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class author_book extends \App\DURC\Models\author_book
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'author', //from belongs to
			'book', //from belongs to
			'authortype', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'author_id', //int
			//'book_id', //int
			//'authortype_id', //int
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the author for this author_book in author_book
*       but you can extend or override the defaults by editing this function...
*/
	public function author(){
		return parent::author();
	}


/**
*	DURC is handling the book for this author_book in author_book
*       but you can extend or override the defaults by editing this function...
*/
	public function book(){
		return parent::book();
	}


/**
*	DURC is handling the authortype for this author_book in author_book
*       but you can extend or override the defaults by editing this function...
*/
	public function authortype(){
		return parent::authortype();
	}


	//your stuff goes here..
	

}//end author_book