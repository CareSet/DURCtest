<?php

namespace App;
/*
	funnything: controls aaaDurctest.funnything

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class funnything extends \App\DURC\Models\funnything
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'thisint', //int
			//'thisfloat', //float
			//'thisdecimal', //decimal
			//'thisvarchar', //varchar
			//'thisdate', //date
			//'thisdatetime', //datetime
			//'thistimestamp', //timestamp
			//'thischar', //char
			//'thistext', //text
			//'thisblob', //blob
			//'thistinyint', //tinyint
			//'thistinytext', //tinytext
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end funnything