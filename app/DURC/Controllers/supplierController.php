<?php

namespace App\DURC\Controllers;

use App\supplier;
use Illuminate\Http\Request;
use CareSet\DURC\DURC;
use CareSet\DURC\DURCController;
use Illuminate\Support\Facades\View;

class supplierController extends DURCController
{


	public $view_data = [];

	protected static $hidden_fields_array = [

	];


	public function getWithArgumentArray(){
		
		$with_summary_array = [];

		return($with_summary_array);
		
	}


	private function _get_index_list(Request $request){

		$return_me = [];

		$with_argument = $this->getWithArgumentArray();

		$these = supplier::with($with_argument)->paginate(100);

        	foreach($these->toArray() as $key => $value){ //add the contents of the obj to the the view 
			$return_me[$key] = $value;
        	}

		//collapse and format joined data..
		$return_me_data = [];
        foreach($return_me['data'] as $data_i => $data_row){
                foreach($data_row as $key => $value){
                        if(is_array($value)){
                                foreach($value as $lowest_key => $lowest_data){
                                        //then this is a loaded attribute..
                                        //lets move it one level higher...

                                        if ( isset( supplier::$field_type_map[$lowest_key] ) ) {
                                            $field_type = supplier::$field_type_map[ $lowest_key ];
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = DURC::formatForDisplay( $field_type, $lowest_key, $lowest_data, true );
                                        } else {
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = $lowest_data;
                                        }
                                }
                        }

                        if ( isset( supplier::$field_type_map[$key] ) ) {
                            $field_type = supplier::$field_type_map[ $key ];
                            $return_me_data[$data_i][$key] = DURC::formatForDisplay( $field_type, $key, $value, true );
                        } else {
                            $return_me_data[$data_i][$key] = $value;
                        }
                }
        }
        $return_me['data'] = $return_me_data;
		
		
                foreach($return_me['data'] as $data_i => $data_row){
                        foreach($data_row as $key => $value){
                                if(is_array($value)){
                                        foreach($value as $lowest_key => $lowest_data){
                                                //then this is a loaded attribute..
                                                //lets move it one level higher...
                                                $return_me['data'][$data_i][$key .'_id_DURClabel'] = $lowest_data;
                                        }
                                        unset($return_me['data'][$data_i][$key]);
                                }
                        }
                }


		//helps with logic-less templating...
		if($return_me['first_page_url'] == $return_me['last_page_url']){
			$return_me['is_need_paging'] = false;
		}else{
			$return_me['is_need_paging'] = true;
		}

		if($return_me['current_page'] == 1){
			$return_me['first_page_class'] = 'disabled';
			$return_me['prev_page_class'] = 'disabled';
		}else{
			$return_me['first_page_class'] = '';
			$return_me['prev_page_class'] = '';
		}


		if($return_me['current_page'] == $return_me['last_page']){
			$return_me['next_page_class'] = 'disabled';
			$return_me['last_page_class'] = 'disabled';
		}else{
			$return_me['next_page_class'] = '';
			$return_me['last_page_class'] = '';
		}

		return($return_me);
	}

	/**
	*	A simple function that allows fo rthe searching of this object type in the db, 
	*	And returns the results in a select2-json compatible way.
	*	This powers the select2 widgets across the forms...
	*/
   	public function search(Request $request){

		$q = $request->input('q');

		//TODO we need to escape this query string to avoid SQL injection.

		//what is the field I should be searching
                $search_fields = supplier::getSearchFields();

		//sometimes there is an image field that contains the url of an image
		//but this is typically null
		$img_field = supplier::getImgField();

		$where_sql = '';
		$or = '';
		foreach($search_fields as $this_field){
			$where_sql .= " $or $this_field LIKE '%$q%'  ";
			$or = ' OR ';
		}

		$these = supplier::whereRaw($where_sql)
					->take(20)
					->get();


		$return_me['pagination'] = ['more' => false];
		$raw_array = $these->toArray();

		$real_array = [];
		foreach($raw_array as $this_row){
			$tmp = [ 'id' => $this_row['id']];
			$tmp_text = '';
			foreach($this_row as $field => $data){
				if(in_array($field,$search_fields)){
					//then we need to show this text!!
					$tmp_text .=  "$data ";
				}
			}
			$tmp['text'] = trim($tmp_text);

			if(!is_null($img_field)){ //then there is an image for this entry
				$tmp['img_field'] = $img_field;
				if(isset($this_row[$img_field])){
					$tmp['img_url'] = $this_row[$img_field];
				}else{	
					$tmp['img_url'] = null;
				}
			}

			$real_array[] = $tmp;
		}


		$return_me['results'] = $real_array;

		// you might this helpful for debugging..
		//$return_me['where'] = $where_sql;

		return response()->json($return_me);

	}

    /**
     * Get a json version of all the objects.. 
     * @param  \App\supplier  $supplier
     * @return JSON of the object
     */
    public function jsonall(Request $request){
		return response()->json($this->_get_index_list($request));
 	}

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
	$main_template_name = $this->_getMainTemplateName();


	$this->view_data = $this->_get_index_list($request);

	if($request->has('debug')){
		var_export($this->view_data);
		exit();
	}
	$durc_template_results = view('DURC.supplier.index',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }


    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */ 
    public function store(Request $request){

	$myNewsupplier = new supplier();

	//the games we play to easily auto-generate code..
	$tmp_supplier = $myNewsupplier;
	if (!empty($request->id) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('id') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->id))) {
		$tmp_supplier->id = DURC::formatForStorage( 'id', 'int', $request->id ); 
}if (!empty($request->company) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('company') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->company))) {
		$tmp_supplier->company = DURC::formatForStorage( 'company', 'varchar', $request->company ); 
}if (!empty($request->lastName) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('lastName') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->lastName))) {
		$tmp_supplier->lastName = DURC::formatForStorage( 'lastName', 'varchar', $request->lastName ); 
}if (!empty($request->firstName) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('firstName') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->firstName))) {
		$tmp_supplier->firstName = DURC::formatForStorage( 'firstName', 'varchar', $request->firstName ); 
}if (!empty($request->emailAddress) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('emailAddress') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->emailAddress))) {
		$tmp_supplier->emailAddress = DURC::formatForStorage( 'emailAddress', 'varchar', $request->emailAddress ); 
}if (!empty($request->jobTitle) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('jobTitle') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->jobTitle))) {
		$tmp_supplier->jobTitle = DURC::formatForStorage( 'jobTitle', 'varchar', $request->jobTitle ); 
}if (!empty($request->businessPhone) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('businessPhone') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->businessPhone))) {
		$tmp_supplier->businessPhone = DURC::formatForStorage( 'businessPhone', 'varchar', $request->businessPhone ); 
}if (!empty($request->homePhone) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('homePhone') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->homePhone))) {
		$tmp_supplier->homePhone = DURC::formatForStorage( 'homePhone', 'varchar', $request->homePhone ); 
}if (!empty($request->mobilePhone) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('mobilePhone') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->mobilePhone))) {
		$tmp_supplier->mobilePhone = DURC::formatForStorage( 'mobilePhone', 'varchar', $request->mobilePhone ); 
}if (!empty($request->faxNumber) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('faxNumber') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->faxNumber))) {
		$tmp_supplier->faxNumber = DURC::formatForStorage( 'faxNumber', 'varchar', $request->faxNumber ); 
}if (!empty($request->address) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('address') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->address))) {
		$tmp_supplier->address = DURC::formatForStorage( 'address', 'longtext', $request->address ); 
}if (!empty($request->city) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('city') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->city))) {
		$tmp_supplier->city = DURC::formatForStorage( 'city', 'varchar', $request->city ); 
}if (!empty($request->stateProvince) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('stateProvince') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->stateProvince))) {
		$tmp_supplier->stateProvince = DURC::formatForStorage( 'stateProvince', 'varchar', $request->stateProvince ); 
}if (!empty($request->zipPostalCode) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('zipPostalCode') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->zipPostalCode))) {
		$tmp_supplier->zipPostalCode = DURC::formatForStorage( 'zipPostalCode', 'varchar', $request->zipPostalCode ); 
}if (!empty($request->countryRegion) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('countryRegion') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->countryRegion))) {
		$tmp_supplier->countryRegion = DURC::formatForStorage( 'countryRegion', 'varchar', $request->countryRegion ); 
}if (!empty($request->webPage) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('webPage') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->webPage))) {
		$tmp_supplier->webPage = DURC::formatForStorage( 'webPage', 'longtext', $request->webPage ); 
}if (!empty($request->notes) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('notes') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->notes))) {
		$tmp_supplier->notes = DURC::formatForStorage( 'notes', 'longtext', $request->notes ); 
}if (!empty($request->attachments) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('attachments') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->attachments))) {
		$tmp_supplier->attachments = DURC::formatForStorage( 'attachments', 'longblob', $request->attachments ); 
}		$tmp_supplier->save();


	$new_id = $myNewsupplier->id;

	return redirect("/DURC/supplier/$new_id")->with('status', 'Data Saved!');
    }//end store function

    /**
     * Display the specified resource.
     * @param  \App\$supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(supplier $supplier){
	return($this->edit($supplier));
    }

    /**
     * Get a json version of the given object 
     * @param  \App\supplier  $supplier
     * @return JSON of the object
     */
    public function jsonone(Request $request, $supplier_id){
		$supplier = \App\supplier::find($supplier_id);
		$supplier = $supplier->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models
		$return_me_array = $supplier->toArray();
		
		//lets see if we can calculate a card-img-top for a front end bootstrap card interface
		$img_uri_field = \App\supplier::getImgField();
		if(!is_null($img_uri_field)){ //then this object has an image link..
			if(!isset($return_me_array['card_img_top'])){ //allow the user to use this as a field without pestering..
				$return_me_array['card_img_top'] = $supplier->$img_uri_field;
			}
		}

		//lets get a card_body from the DURC mode class!!
		if(!isset($return_me_array['card_body'])){ //allow the user to use this as a field without pestering..
			//this is simply the name unless someone has put work into this...
			$return_me_array['card_body'] = $supplier->getCardBody();
		}
		
		return response()->json($return_me_array);
 	}


    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(){
	// but really, we are just going to edit a new object..
	$new_instance = new supplier();
	return $this->edit($new_instance);
    }


    /**
     * Show the form for editing the specified resource.
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(supplier $supplier){

	$main_template_name = $this->_getMainTemplateName();

	//do we have a status message in the session? The view needs it...
	$this->view_data['session_status'] = session('status',false);
	if($this->view_data['session_status']){
		$this->view_data['has_session_status'] = true;
	}else{
		$this->view_data['has_session_status'] = false;
	}

	$this->view_data['csrf_token'] = csrf_token();
	
	
	foreach ( supplier::$field_type_map as $column_name => $field_type ) {
        // If this field name is in the configured list of hidden fields, do not display the row.
        $this->view_data["{$column_name}_row_class"] = '';
        if ( in_array( $column_name, self::$hidden_fields_array ) ) {
            $this->view_data["{$column_name}_row_class"] = 'd-none';
        }
    }

	if($supplier->exists){	//we will not have old data if this is a new object

		//well lets properly eager load this object with a refresh to load all of the related things
		$supplier = $supplier->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models

		//put the contents into the view...
		foreach($supplier->toArray() as $key => $value){
			if ( isset( supplier::$field_type_map[$key] ) ) {
                $field_type = supplier::$field_type_map[ $key ];
                $this->view_data[$key] = DURC::formatForDisplay( $field_type, $key, $value );
            } else {
                $this->view_data[$key] = $value;
            }
		}

		//what is this object called?
		$name_field = $supplier->_getBestName();
		$this->view_data['is_new'] = false;
		$this->view_data['durc_instance_name'] = $supplier->$name_field;
	}else{
		$this->view_data['is_new'] = true;
	}

	$debug = false;
	if($debug){
		echo '<pre>';
		var_export($this->view_data);
		exit();
	}
	

	$durc_template_results = view('DURC.supplier.edit',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, supplier $supplier){

	$tmp_supplier = $supplier;
	if (!empty($request->id) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('id') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->id))) {
		$tmp_supplier->id = DURC::formatForStorage( 'id', 'int', $request->id ); 
}if (!empty($request->company) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('company') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->company))) {
		$tmp_supplier->company = DURC::formatForStorage( 'company', 'varchar', $request->company ); 
}if (!empty($request->lastName) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('lastName') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->lastName))) {
		$tmp_supplier->lastName = DURC::formatForStorage( 'lastName', 'varchar', $request->lastName ); 
}if (!empty($request->firstName) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('firstName') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->firstName))) {
		$tmp_supplier->firstName = DURC::formatForStorage( 'firstName', 'varchar', $request->firstName ); 
}if (!empty($request->emailAddress) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('emailAddress') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->emailAddress))) {
		$tmp_supplier->emailAddress = DURC::formatForStorage( 'emailAddress', 'varchar', $request->emailAddress ); 
}if (!empty($request->jobTitle) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('jobTitle') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->jobTitle))) {
		$tmp_supplier->jobTitle = DURC::formatForStorage( 'jobTitle', 'varchar', $request->jobTitle ); 
}if (!empty($request->businessPhone) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('businessPhone') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->businessPhone))) {
		$tmp_supplier->businessPhone = DURC::formatForStorage( 'businessPhone', 'varchar', $request->businessPhone ); 
}if (!empty($request->homePhone) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('homePhone') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->homePhone))) {
		$tmp_supplier->homePhone = DURC::formatForStorage( 'homePhone', 'varchar', $request->homePhone ); 
}if (!empty($request->mobilePhone) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('mobilePhone') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->mobilePhone))) {
		$tmp_supplier->mobilePhone = DURC::formatForStorage( 'mobilePhone', 'varchar', $request->mobilePhone ); 
}if (!empty($request->faxNumber) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('faxNumber') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->faxNumber))) {
		$tmp_supplier->faxNumber = DURC::formatForStorage( 'faxNumber', 'varchar', $request->faxNumber ); 
}if (!empty($request->address) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('address') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->address))) {
		$tmp_supplier->address = DURC::formatForStorage( 'address', 'longtext', $request->address ); 
}if (!empty($request->city) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('city') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->city))) {
		$tmp_supplier->city = DURC::formatForStorage( 'city', 'varchar', $request->city ); 
}if (!empty($request->stateProvince) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('stateProvince') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->stateProvince))) {
		$tmp_supplier->stateProvince = DURC::formatForStorage( 'stateProvince', 'varchar', $request->stateProvince ); 
}if (!empty($request->zipPostalCode) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('zipPostalCode') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->zipPostalCode))) {
		$tmp_supplier->zipPostalCode = DURC::formatForStorage( 'zipPostalCode', 'varchar', $request->zipPostalCode ); 
}if (!empty($request->countryRegion) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('countryRegion') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->countryRegion))) {
		$tmp_supplier->countryRegion = DURC::formatForStorage( 'countryRegion', 'varchar', $request->countryRegion ); 
}if (!empty($request->webPage) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('webPage') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->webPage))) {
		$tmp_supplier->webPage = DURC::formatForStorage( 'webPage', 'longtext', $request->webPage ); 
}if (!empty($request->notes) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('notes') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->notes))) {
		$tmp_supplier->notes = DURC::formatForStorage( 'notes', 'longtext', $request->notes ); 
}if (!empty($request->attachments) || // If a value is passed, always use the value
    ($tmp_supplier->isFieldNullable('attachments') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->attachments))) {
		$tmp_supplier->attachments = DURC::formatForStorage( 'attachments', 'longblob', $request->attachments ); 
}		$tmp_supplier->save();


	$id = $supplier->id;

	return redirect("/DURC/supplier/$id")->with('status', 'Data Saved!');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(supplier $supplier){
	    return supplier::destroy( $supplier->id );  
    }
    
    /**
     * Restore the specified resource from storage.
     * @param  $id ID of resource
     * @return \Illuminate\Http\Response
     */
    public function restore( $id )
    {
        $supplier = supplier::withTrashed()->find($id)->restore();
        return redirect("/DURC/test_soft_delete/$id")->with('status', 'Data Restored!');
    }
}
