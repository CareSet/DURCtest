<?php

namespace App;
/*
	comment: controls aaaDurctest.comment

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.

DURC Generated At: Monday 1st of January 2018 04:58:04 PM

*/
class comment extends \App\DURC\Models\DURC_comment
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'post', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'comment_text', //varchar
			//'post_id', //int
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array

//DURC HAS_MANY SECTION			//DURC did not detect any has_many relationships//DURC BELONGS_TO SECTION
/**
*	DURC is handling the post for this comment in DURC_comment
*       but you can extend or override the defaults by editing this function...
*/
	public function post(){
		return parent::post();
	}


	//your stuff goes here..
	

}//end comment