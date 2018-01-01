<?php

namespace App\DURC\Controllers;

use App\customer;
use Illuminate\Http\Request;
use CareSet\DURC\DURCController;
use Illuminate\Support\Facades\View;

//DURC Generated At: Monday 1st of January 2018 04:58:04 PM
class DURC_customerController extends DURCController
{


	public $view_data = [];


	public function getWithArgumentArray(){
		
		$with_summary_array = [];

		return($with_summary_array);
		
	}


	private function _get_index_list(Request $request){

		$return_me = [];

		$with_argument = $this->getWithArgumentArray();

		$these = customer::with($with_argument)->paginate(100);

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
                $search_fields = customer::getSearchFields();

		$where_sql = '';
		$or = '';
		foreach($search_fields as $this_field){
			$where_sql .= " $or $this_field LIKE '%$q%'  ";
			$or = ' OR ';
		}

		$these = customer::whereRaw($where_sql)
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
     * @param  \App\customer  $customer
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
	$durc_template_results = view('DURC.customer.index',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }


    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */ 
    public function store(Request $request){

	$myNewcustomer = new customer();

	//the games we play to easily auto-generate code..
	$tmp_customer = $myNewcustomer;
			$tmp_customer->id = $request->id; 
		$tmp_customer->companyName = $request->companyName; 
		$tmp_customer->lastName = $request->lastName; 
		$tmp_customer->firstName = $request->firstName; 
		$tmp_customer->emailAddress = $request->emailAddress; 
		$tmp_customer->jobTitle = $request->jobTitle; 
		$tmp_customer->businessPhone = $request->businessPhone; 
		$tmp_customer->homePhone = $request->homePhone; 
		$tmp_customer->mobilePhone = $request->mobilePhone; 
		$tmp_customer->faxNumber = $request->faxNumber; 
		$tmp_customer->address = $request->address; 
		$tmp_customer->city = $request->city; 
		$tmp_customer->stateProvince = $request->stateProvince; 
		$tmp_customer->zipPostalCode = $request->zipPostalCode; 
		$tmp_customer->countryRegion = $request->countryRegion; 
		$tmp_customer->webPage = $request->webPage; 
		$tmp_customer->notes = $request->notes; 
		$tmp_customer->attachments = $request->attachments; 
		$tmp_customer->random_date = $request->random_date; 
		$tmp_customer->created_at = $request->created_at; 
		$tmp_customer->updated_at = $request->updated_at; 
		$tmp_customer->deleted_at = $request->deleted_at; 
		$tmp_customer->save();


	$new_id = $myNewcustomer->id;

	return redirect("/DURC/customer/$new_id")->with('status', 'Data Saved!');
    }//end store function

    /**
     * Display the specified resource.
     * @param  \App\$customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer){
	return($this->edit($customer));
    }

    /**
     * Get a json version of the given object 
     * @param  \App\customer  $customer
     * @return JSON of the object
     */
    public function jsonone(Request $request, $customer_id){
		$customer = \App\customer::find($customer_id);
		$customer = $customer->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models
		return response()->json($customer->toArray());
 	}


    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(){
	// but really, we are just going to edit a new object..
	$new_instance = new customer();
	return $this->edit($new_instance);
    }


    /**
     * Show the form for editing the specified resource.
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer){

	$main_template_name = $this->_getMainTemplateName();

	//do we have a status message in the session? The view needs it...
	$this->view_data['session_status'] = session('status',false);
	if($this->view_data['session_status']){
		$this->view_data['has_session_status'] = true;
	}else{
		$this->view_data['has_session_status'] = false;
	}

	$this->view_data['csrf_token'] = csrf_token();

	if($customer->exists()){	//we will not have old data if this is a new object

		//well lets properly eager load this object with a refresh to load all of the related things
		$customer = $customer->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models

		//put the contents into the view...
		foreach($customer->toArray() as $key => $value){
			$this->view_data[$key] = $value;	
		}

		//what is this object called?
		$name_field = $customer->_getBestName();
		$this->view_data['is_new'] = false;
		$this->view_data['durc_instance_name'] = $customer->$name_field;
	}else{
		$this->view_data['is_new'] = true;
	}

	$debug = false;
	if($debug){
		echo '<pre>';
		var_export($this->view_data);
		exit();
	}
	

	$durc_template_results = view('DURC.customer.edit',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer $customer){

	$tmp_customer = $customer;
			$tmp_customer->id = $request->id; 
		$tmp_customer->companyName = $request->companyName; 
		$tmp_customer->lastName = $request->lastName; 
		$tmp_customer->firstName = $request->firstName; 
		$tmp_customer->emailAddress = $request->emailAddress; 
		$tmp_customer->jobTitle = $request->jobTitle; 
		$tmp_customer->businessPhone = $request->businessPhone; 
		$tmp_customer->homePhone = $request->homePhone; 
		$tmp_customer->mobilePhone = $request->mobilePhone; 
		$tmp_customer->faxNumber = $request->faxNumber; 
		$tmp_customer->address = $request->address; 
		$tmp_customer->city = $request->city; 
		$tmp_customer->stateProvince = $request->stateProvince; 
		$tmp_customer->zipPostalCode = $request->zipPostalCode; 
		$tmp_customer->countryRegion = $request->countryRegion; 
		$tmp_customer->webPage = $request->webPage; 
		$tmp_customer->notes = $request->notes; 
		$tmp_customer->attachments = $request->attachments; 
		$tmp_customer->random_date = $request->random_date; 
		$tmp_customer->created_at = $request->created_at; 
		$tmp_customer->updated_at = $request->updated_at; 
		$tmp_customer->deleted_at = $request->deleted_at; 
		$tmp_customer->save();


	$id = $customer->id;

	return redirect("/DURC/customer/$id")->with('status', 'Data Saved!');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer){
	$main_template_name = $this->_getMainTemplateName();
	$durc_template_results = view('DURC.customer.destroy');        
	return view($main_template_name,['content' => $durc_template_results]);
    }
}
