<?php

namespace App;
/*
	vote: controls aaaDurctest.vote

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class vote extends \App\DURC\Models\vote
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
			//'post_id', //int
			//'votenum', //varchar
			//'updated_at', //datetime
			//'created_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the post for this vote in vote
*       but you can extend or override the defaults by editing this function...
*/
	public function post(){
		return parent::post();
	}


	//your stuff goes here..
	

}//end vote