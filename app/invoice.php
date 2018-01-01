<?php

namespace App;
/*
	invoice: controls northwind_data.invoice

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.

DURC Generated At: Monday 1st of January 2018 04:58:04 PM

*/
class invoice extends \App\DURC\Models\DURC_invoice
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'order', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'order_id', //int
			//'invoiceDate', //datetime
			//'dueDate', //datetime
			//'tax', //decimal
			//'shipping', //decimal
			//'amountDue', //decimal
		]; //end hidden array

//DURC HAS_MANY SECTION			//DURC did not detect any has_many relationships//DURC BELONGS_TO SECTION
/**
*	DURC is handling the order for this invoice in DURC_invoice
*       but you can extend or override the defaults by editing this function...
*/
	public function order(){
		return parent::order();
	}


	//your stuff goes here..
	

}//end invoice