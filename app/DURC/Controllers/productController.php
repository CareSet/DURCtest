<?php

namespace App\DURC\Controllers;

use App\product;
use Illuminate\Http\Request;
use CareSet\DURC\DURC;
use CareSet\DURC\DURCController;
use Illuminate\Support\Facades\View;

class productController extends DURCController
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

		$these = product::with($with_argument)->paginate(100);

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

                                        if ( isset( product::$field_type_map[$lowest_key] ) ) {
                                            $field_type = product::$field_type_map[ $lowest_key ];
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = DURC::formatForDisplay( $field_type, $lowest_key, $lowest_data, true );
                                        } else {
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = $lowest_data;
                                        }
                                }
                        }

                        if ( isset( product::$field_type_map[$key] ) ) {
                            $field_type = product::$field_type_map[ $key ];
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
                $search_fields = product::getSearchFields();

		//sometimes there is an image field that contains the url of an image
		//but this is typically null
		$img_field = product::getImgField();

		$where_sql = '';
		$or = '';
		foreach($search_fields as $this_field){
			$where_sql .= " $or $this_field LIKE '%$q%'  ";
			$or = ' OR ';
		}

		$these = product::whereRaw($where_sql)
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
     * @param  \App\product  $product
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
	$durc_template_results = view('DURC.product.index',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }


    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */ 
    public function store(Request $request){

	$myNewproduct = new product();

	//the games we play to easily auto-generate code..
	$tmp_product = $myNewproduct;
	if (!empty($request->supplier_ids) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('supplier_ids') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->supplier_ids))) {
		$tmp_product->supplier_ids = DURC::formatForStorage( 'supplier_ids', 'longtext', $request->supplier_ids ); 
}if (!empty($request->id) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('id') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->id))) {
		$tmp_product->id = DURC::formatForStorage( 'id', 'int', $request->id ); 
}if (!empty($request->productCode) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('productCode') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->productCode))) {
		$tmp_product->productCode = DURC::formatForStorage( 'productCode', 'varchar', $request->productCode ); 
}if (!empty($request->productName) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('productName') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->productName))) {
		$tmp_product->productName = DURC::formatForStorage( 'productName', 'varchar', $request->productName ); 
}if (!empty($request->description) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('description') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->description))) {
		$tmp_product->description = DURC::formatForStorage( 'description', 'longtext', $request->description ); 
}if (!empty($request->standardCost) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('standardCost') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->standardCost))) {
		$tmp_product->standardCost = DURC::formatForStorage( 'standardCost', 'decimal', $request->standardCost ); 
}if (!empty($request->listPrice) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('listPrice') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->listPrice))) {
		$tmp_product->listPrice = DURC::formatForStorage( 'listPrice', 'decimal', $request->listPrice ); 
}if (!empty($request->reorderLevel) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('reorderLevel') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->reorderLevel))) {
		$tmp_product->reorderLevel = DURC::formatForStorage( 'reorderLevel', 'int', $request->reorderLevel ); 
}if (!empty($request->targetLevel) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('targetLevel') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->targetLevel))) {
		$tmp_product->targetLevel = DURC::formatForStorage( 'targetLevel', 'int', $request->targetLevel ); 
}if (!empty($request->quantityPerUnit) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('quantityPerUnit') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->quantityPerUnit))) {
		$tmp_product->quantityPerUnit = DURC::formatForStorage( 'quantityPerUnit', 'varchar', $request->quantityPerUnit ); 
}if (!empty($request->discontinued) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('discontinued') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->discontinued))) {
		$tmp_product->discontinued = DURC::formatForStorage( 'discontinued', 'tinyint', $request->discontinued ); 
}if (!empty($request->minimumReorderQuantity) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('minimumReorderQuantity') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->minimumReorderQuantity))) {
		$tmp_product->minimumReorderQuantity = DURC::formatForStorage( 'minimumReorderQuantity', 'int', $request->minimumReorderQuantity ); 
}if (!empty($request->category) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('category') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->category))) {
		$tmp_product->category = DURC::formatForStorage( 'category', 'varchar', $request->category ); 
}if (!empty($request->attachments) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('attachments') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->attachments))) {
		$tmp_product->attachments = DURC::formatForStorage( 'attachments', 'longblob', $request->attachments ); 
}		$tmp_product->save();


	$new_id = $myNewproduct->id;

	return redirect("/DURC/product/$new_id")->with('status', 'Data Saved!');
    }//end store function

    /**
     * Display the specified resource.
     * @param  \App\$product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product){
	return($this->edit($product));
    }

    /**
     * Get a json version of the given object 
     * @param  \App\product  $product
     * @return JSON of the object
     */
    public function jsonone(Request $request, $product_id){
		$product = \App\product::find($product_id);
		$product = $product->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models
		$return_me_array = $product->toArray();
		
		//lets see if we can calculate a card-img-top for a front end bootstrap card interface
		$img_uri_field = \App\product::getImgField();
		if(!is_null($img_uri_field)){ //then this object has an image link..
			if(!isset($return_me_array['card_img_top'])){ //allow the user to use this as a field without pestering..
				$return_me_array['card_img_top'] = $product->$img_uri_field;
			}
		}

		//lets get a card_body from the DURC mode class!!
		if(!isset($return_me_array['card_body'])){ //allow the user to use this as a field without pestering..
			//this is simply the name unless someone has put work into this...
			$return_me_array['card_body'] = $product->getCardBody();
		}
		
		return response()->json($return_me_array);
 	}


    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(){
	// but really, we are just going to edit a new object..
	$new_instance = new product();
	return $this->edit($new_instance);
    }


    /**
     * Show the form for editing the specified resource.
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product){

	$main_template_name = $this->_getMainTemplateName();

	//do we have a status message in the session? The view needs it...
	$this->view_data['session_status'] = session('status',false);
	if($this->view_data['session_status']){
		$this->view_data['has_session_status'] = true;
	}else{
		$this->view_data['has_session_status'] = false;
	}

	$this->view_data['csrf_token'] = csrf_token();
	
	
	foreach ( product::$field_type_map as $column_name => $field_type ) {
        // If this field name is in the configured list of hidden fields, do not display the row.
        $this->view_data["{$column_name}_row_class"] = '';
        if ( in_array( $column_name, self::$hidden_fields_array ) ) {
            $this->view_data["{$column_name}_row_class"] = 'd-none';
        }
    }

	if($product->exists){	//we will not have old data if this is a new object

		//well lets properly eager load this object with a refresh to load all of the related things
		$product = $product->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models

		//put the contents into the view...
		foreach($product->toArray() as $key => $value){
			if ( isset( product::$field_type_map[$key] ) ) {
                $field_type = product::$field_type_map[ $key ];
                $this->view_data[$key] = DURC::formatForDisplay( $field_type, $key, $value );
            } else {
                $this->view_data[$key] = $value;
            }
		}

		//what is this object called?
		$name_field = $product->_getBestName();
		$this->view_data['is_new'] = false;
		$this->view_data['durc_instance_name'] = $product->$name_field;
	}else{
		$this->view_data['is_new'] = true;
	}

	$debug = false;
	if($debug){
		echo '<pre>';
		var_export($this->view_data);
		exit();
	}
	

	$durc_template_results = view('DURC.product.edit',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product){

	$tmp_product = $product;
	if (!empty($request->supplier_ids) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('supplier_ids') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->supplier_ids))) {
		$tmp_product->supplier_ids = DURC::formatForStorage( 'supplier_ids', 'longtext', $request->supplier_ids ); 
}if (!empty($request->id) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('id') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->id))) {
		$tmp_product->id = DURC::formatForStorage( 'id', 'int', $request->id ); 
}if (!empty($request->productCode) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('productCode') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->productCode))) {
		$tmp_product->productCode = DURC::formatForStorage( 'productCode', 'varchar', $request->productCode ); 
}if (!empty($request->productName) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('productName') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->productName))) {
		$tmp_product->productName = DURC::formatForStorage( 'productName', 'varchar', $request->productName ); 
}if (!empty($request->description) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('description') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->description))) {
		$tmp_product->description = DURC::formatForStorage( 'description', 'longtext', $request->description ); 
}if (!empty($request->standardCost) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('standardCost') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->standardCost))) {
		$tmp_product->standardCost = DURC::formatForStorage( 'standardCost', 'decimal', $request->standardCost ); 
}if (!empty($request->listPrice) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('listPrice') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->listPrice))) {
		$tmp_product->listPrice = DURC::formatForStorage( 'listPrice', 'decimal', $request->listPrice ); 
}if (!empty($request->reorderLevel) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('reorderLevel') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->reorderLevel))) {
		$tmp_product->reorderLevel = DURC::formatForStorage( 'reorderLevel', 'int', $request->reorderLevel ); 
}if (!empty($request->targetLevel) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('targetLevel') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->targetLevel))) {
		$tmp_product->targetLevel = DURC::formatForStorage( 'targetLevel', 'int', $request->targetLevel ); 
}if (!empty($request->quantityPerUnit) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('quantityPerUnit') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->quantityPerUnit))) {
		$tmp_product->quantityPerUnit = DURC::formatForStorage( 'quantityPerUnit', 'varchar', $request->quantityPerUnit ); 
}if (!empty($request->discontinued) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('discontinued') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->discontinued))) {
		$tmp_product->discontinued = DURC::formatForStorage( 'discontinued', 'tinyint', $request->discontinued ); 
}if (!empty($request->minimumReorderQuantity) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('minimumReorderQuantity') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->minimumReorderQuantity))) {
		$tmp_product->minimumReorderQuantity = DURC::formatForStorage( 'minimumReorderQuantity', 'int', $request->minimumReorderQuantity ); 
}if (!empty($request->category) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('category') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->category))) {
		$tmp_product->category = DURC::formatForStorage( 'category', 'varchar', $request->category ); 
}if (!empty($request->attachments) || // If a value is passed, always use the value
    ($tmp_product->isFieldNullable('attachments') && // OR, if the IS nullable, if an empty string is entered, use empty string when saving whether there is default or not
        empty($request->attachments))) {
		$tmp_product->attachments = DURC::formatForStorage( 'attachments', 'longblob', $request->attachments ); 
}		$tmp_product->save();


	$id = $product->id;

	return redirect("/DURC/product/$id")->with('status', 'Data Saved!');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product){
	    return product::destroy( $product->id );  
    }
    
    /**
     * Restore the specified resource from storage.
     * @param  $id ID of resource
     * @return \Illuminate\Http\Response
     */
    public function restore( $id )
    {
        $product = product::withTrashed()->find($id)->restore();
        return redirect("/DURC/test_soft_delete/$id")->with('status', 'Data Restored!');
    }
}
