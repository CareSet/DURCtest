<?php

namespace App;
/*
	post: controls aaaDurctest.post

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.

DURC Generated At: Monday 1st of January 2018 04:58:04 PM

*/
class post extends \App\DURC\Models\DURC_post
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'comment', //from from many
			'vote', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'title', //varchar
			//'content', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array

//DURC HAS_MANY SECTION
/**
*	DURC is handling the comment for this post in DURC_post
*       but you can extend or override the defaults by editing this function...
*/
	public function comment(){
		return parent::comment();
	}


/**
*	DURC is handling the vote for this post in DURC_post
*       but you can extend or override the defaults by editing this function...
*/
	public function vote(){
		return parent::vote();
	}

//DURC BELONGS_TO SECTION			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end post