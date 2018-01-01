<?php

namespace App\DURC\Controllers;

use App\purchaseorderdetail;
use Illuminate\Http\Request;
use CareSet\DURC\DURCController;
use Illuminate\Support\Facades\View;

//DURC Generated At: Monday 1st of January 2018 04:58:04 PM
class DURC_purchaseorderdetailController extends DURCController
{


	public $view_data = [];


	public function getWithArgumentArray(){
		
		$with_summary_array = [];
		$with_summary_array[] = "purchaseorder:id,".\App\purchaseorder::getNameField();
		$with_summary_array[] = "product:id,".\App\product::getNameField();

		return($with_summary_array);
		
	}


	private function _get_index_list(Request $request){

		$return_me = [];

		$with_argument = $this->getWithArgumentArray();

		$these = purchaseorderdetail::with($with_argument)->paginate(100);

        	foreach($these->toArray() as $key => $value){ //add the contents of the obj to the the view 
			$return_me[$key] = $value;
        	}

		//collapse joined data..
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
                $search_fields = purchaseorderdetail::getSearchFields();

		$where_sql = '';
		$or = '';
		foreach($search_fields as $this_field){
			$where_sql .= " $or $this_field LIKE '%$q%'  ";
			$or = ' OR ';
		}

		$these = purchaseorderdetail::whereRaw($where_sql)
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
			$tmp['text'] = $tmp_text;
			$real_array[] = $tmp;
		}


		$return_me['results'] = $real_array;

		// you might this helpful for debugging..
		//$return_me['where'] = $where_sql;

		return response()->json($return_me);

	}

    /**
     * Get a json version of all the objects.. 
     * @param  \App\purchaseorderdetail  $purchaseorderdetail
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
	$durc_template_results = view('DURC.purchaseorderdetail.index',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }


    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */ 
    public function store(Request $request){

	$myNewpurchaseorderdetail = new purchaseorderdetail();

	//the games we play to easily auto-generate code..
	$tmp_purchaseorderdetail = $myNewpurchaseorderdetail;
			$tmp_purchaseorderdetail->id = $request->id; 
		$tmp_purchaseorderdetail->purchaseOrder_id = $request->purchaseOrder_id; 
		$tmp_purchaseorderdetail->product_id = $request->product_id; 
		$tmp_purchaseorderdetail->quantity = $request->quantity; 
		$tmp_purchaseorderdetail->unitCost = $request->unitCost; 
		$tmp_purchaseorderdetail->dateReceived = $request->dateReceived; 
		$tmp_purchaseorderdetail->postedToInventory = $request->postedToInventory; 
		$tmp_purchaseorderdetail->inventory_id = $request->inventory_id; 
		$tmp_purchaseorderdetail->save();


	$new_id = $myNewpurchaseorderdetail->id;

	return redirect("/DURC/purchaseorderdetail/$new_id")->with('status', 'Data Saved!');
    }//end store function

    /**
     * Display the specified resource.
     * @param  \App\$purchaseorderdetail  $purchaseorderdetail
     * @return \Illuminate\Http\Response
     */
    public function show(purchaseorderdetail $purchaseorderdetail){
	return($this->edit($purchaseorderdetail));
    }

    /**
     * Get a json version of the given object 
     * @param  \App\purchaseorderdetail  $purchaseorderdetail
     * @return JSON of the object
     */
    public function jsonone(Request $request, $purchaseorderdetail_id){
		$purchaseorderdetail = \App\purchaseorderdetail::find($purchaseorderdetail_id);
		$purchaseorderdetail = $purchaseorderdetail->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models
		return response()->json($purchaseorderdetail->toArray());
 	}


    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(){
	// but really, we are just going to edit a new object..
	$new_instance = new purchaseorderdetail();
	return $this->edit($new_instance);
    }


    /**
     * Show the form for editing the specified resource.
     * @param  \App\purchaseorderdetail  $purchaseorderdetail
     * @return \Illuminate\Http\Response
     */
    public function edit(purchaseorderdetail $purchaseorderdetail){

	$main_template_name = $this->_getMainTemplateName();

	//do we have a status message in the session? The view needs it...
	$this->view_data['session_status'] = session('status',false);
	if($this->view_data['session_status']){
		$this->view_data['has_session_status'] = true;
	}else{
		$this->view_data['has_session_status'] = false;
	}

	$this->view_data['csrf_token'] = csrf_token();

	if($purchaseorderdetail->exists()){	//we will not have old data if this is a new object

		//well lets properly eager load this object with a refresh to load all of the related things
		$purchaseorderdetail = $purchaseorderdetail->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models

		//put the contents into the view...
		foreach($purchaseorderdetail->toArray() as $key => $value){
			$this->view_data[$key] = $value;	
		}

		//what is this object called?
		$name_field = $purchaseorderdetail->_getBestName();
		$this->view_data['is_new'] = false;
		$this->view_data['durc_instance_name'] = $purchaseorderdetail->$name_field;
	}else{
		$this->view_data['is_new'] = true;
	}

	$debug = false;
	if($debug){
		echo '<pre>';
		var_export($this->view_data);
		exit();
	}
	

	$durc_template_results = view('DURC.purchaseorderdetail.edit',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\purchaseorderdetail  $purchaseorderdetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, purchaseorderdetail $purchaseorderdetail){

	$tmp_purchaseorderdetail = $purchaseorderdetail;
			$tmp_purchaseorderdetail->id = $request->id; 
		$tmp_purchaseorderdetail->purchaseOrder_id = $request->purchaseOrder_id; 
		$tmp_purchaseorderdetail->product_id = $request->product_id; 
		$tmp_purchaseorderdetail->quantity = $request->quantity; 
		$tmp_purchaseorderdetail->unitCost = $request->unitCost; 
		$tmp_purchaseorderdetail->dateReceived = $request->dateReceived; 
		$tmp_purchaseorderdetail->postedToInventory = $request->postedToInventory; 
		$tmp_purchaseorderdetail->inventory_id = $request->inventory_id; 
		$tmp_purchaseorderdetail->save();


	$id = $purchaseorderdetail->id;

	return redirect("/DURC/purchaseorderdetail/$id")->with('status', 'Data Saved!');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\purchaseorderdetail  $purchaseorderdetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(purchaseorderdetail $purchaseorderdetail){
	$main_template_name = $this->_getMainTemplateName();
	$durc_template_results = view('DURC.purchaseorderdetail.destroy');        
	return view($main_template_name,['content' => $durc_template_results]);
    }
}
