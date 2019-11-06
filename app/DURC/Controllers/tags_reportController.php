<?php

namespace App\DURC\Controllers;

use App\tags_report;
use Illuminate\Http\Request;
use CareSet\DURC\DURC;
use CareSet\DURC\DURCController;
use Illuminate\Support\Facades\View;

class tags_reportController extends DURCController
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

		$these = tags_report::with($with_argument)->paginate(100);

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

                                        if ( isset( tags_report::$field_type_map[$lowest_key] ) ) {
                                            $field_type = tags_report::$field_type_map[ $lowest_key ];
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = DURC::formatForDisplay( $field_type, $lowest_key, $lowest_data, true );
                                        } else {
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = $lowest_data;
                                        }
                                }
                        }

                        if ( isset( tags_report::$field_type_map[$key] ) ) {
                            $field_type = tags_report::$field_type_map[ $key ];
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
                $search_fields = tags_report::getSearchFields();

		//sometimes there is an image field that contains the url of an image
		//but this is typically null
		$img_field = tags_report::getImgField();

		$where_sql = '';
		$or = '';
		foreach($search_fields as $this_field){
			$where_sql .= " $or $this_field LIKE '%$q%'  ";
			$or = ' OR ';
		}

		$these = tags_report::whereRaw($where_sql)
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
     * @param  \App\tags_report  $tags_report
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
	$durc_template_results = view('DURC.tags_report.index',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }


    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */ 
    public function store(Request $request){

	$myNewtags_report = new tags_report();

	//the games we play to easily auto-generate code..
	$tmp_tags_report = $myNewtags_report;
			$tmp_tags_report->id = DURC::formatForStorage( 'id', 'bigint', $request->id ); 
		$tmp_tags_report->field_to_bold_in_report_display = DURC::formatForStorage( 'field_to_bold_in_report_display', 'varchar', $request->field_to_bold_in_report_display ); 
		$tmp_tags_report->field_to_hide_by_default = DURC::formatForStorage( 'field_to_hide_by_default', 'varchar', $request->field_to_hide_by_default ); 
		$tmp_tags_report->field_to_italic_in_report_display = DURC::formatForStorage( 'field_to_italic_in_report_display', 'varchar', $request->field_to_italic_in_report_display ); 
		$tmp_tags_report->field_to_right_align_in_report = DURC::formatForStorage( 'field_to_right_align_in_report', 'varchar', $request->field_to_right_align_in_report ); 
		$tmp_tags_report->field_to_bolditalic_in_report_display = DURC::formatForStorage( 'field_to_bolditalic_in_report_display', 'varchar', $request->field_to_bolditalic_in_report_display ); 
		$tmp_tags_report->numeric_field = DURC::formatForStorage( 'numeric_field', 'int', $request->numeric_field ); 
		$tmp_tags_report->decimal_field = DURC::formatForStorage( 'decimal_field', 'decimal', $request->decimal_field ); 
		$tmp_tags_report->currency_field = DURC::formatForStorage( 'currency_field', 'varchar', $request->currency_field ); 
		$tmp_tags_report->percent_field = DURC::formatForStorage( 'percent_field', 'int', $request->percent_field ); 
		$tmp_tags_report->url_field = DURC::formatForStorage( 'url_field', 'varchar', $request->url_field ); 
		$tmp_tags_report->time_field = DURC::formatForStorage( 'time_field', 'time', $request->time_field ); 
		$tmp_tags_report->date_field = DURC::formatForStorage( 'date_field', 'date', $request->date_field ); 
		$tmp_tags_report->datetime_field = DURC::formatForStorage( 'datetime_field', 'datetime', $request->datetime_field ); 
		$tmp_tags_report->save();


	$new_id = $myNewtags_report->id;

	return redirect("/DURC/tags_report/$new_id")->with('status', 'Data Saved!');
    }//end store function

    /**
     * Display the specified resource.
     * @param  \App\$tags_report  $tags_report
     * @return \Illuminate\Http\Response
     */
    public function show(tags_report $tags_report){
	return($this->edit($tags_report));
    }

    /**
     * Get a json version of the given object 
     * @param  \App\tags_report  $tags_report
     * @return JSON of the object
     */
    public function jsonone(Request $request, $tags_report_id){
		$tags_report = \App\tags_report::find($tags_report_id);
		$tags_report = $tags_report->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models
		$return_me_array = $tags_report->toArray();
		
		//lets see if we can calculate a card-img-top for a front end bootstrap card interface
		$img_uri_field = \App\tags_report::getImgField();
		if(!is_null($img_uri_field)){ //then this object has an image link..
			if(!isset($return_me_array['card_img_top'])){ //allow the user to use this as a field without pestering..
				$return_me_array['card_img_top'] = $tags_report->$img_uri_field;
			}
		}

		//lets get a card_body from the DURC mode class!!
		if(!isset($return_me_array['card_body'])){ //allow the user to use this as a field without pestering..
			//this is simply the name unless someone has put work into this...
			$return_me_array['card_body'] = $tags_report->getCardBody();
		}
		
		return response()->json($return_me_array);
 	}


    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(){
	// but really, we are just going to edit a new object..
	$new_instance = new tags_report();
	return $this->edit($new_instance);
    }


    /**
     * Show the form for editing the specified resource.
     * @param  \App\tags_report  $tags_report
     * @return \Illuminate\Http\Response
     */
    public function edit(tags_report $tags_report){

	$main_template_name = $this->_getMainTemplateName();

	//do we have a status message in the session? The view needs it...
	$this->view_data['session_status'] = session('status',false);
	if($this->view_data['session_status']){
		$this->view_data['has_session_status'] = true;
	}else{
		$this->view_data['has_session_status'] = false;
	}

	$this->view_data['csrf_token'] = csrf_token();
	
	
	foreach ( tags_report::$field_type_map as $column_name => $field_type ) {
        // If this field name is in the configured list of hidden fields, do not display the row.
        $this->view_data["{$column_name}_row_class"] = '';
        if ( in_array( $column_name, self::$hidden_fields_array ) ) {
            $this->view_data["{$column_name}_row_class"] = 'd-none';
        }
    }

	if($tags_report->exists){	//we will not have old data if this is a new object

		//well lets properly eager load this object with a refresh to load all of the related things
		$tags_report = $tags_report->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models

		//put the contents into the view...
		foreach($tags_report->toArray() as $key => $value){
			if ( isset( tags_report::$field_type_map[$key] ) ) {
                $field_type = tags_report::$field_type_map[ $key ];
                $this->view_data[$key] = DURC::formatForDisplay( $field_type, $key, $value );
            } else {
                $this->view_data[$key] = $value;
            }
		}

		//what is this object called?
		$name_field = $tags_report->_getBestName();
		$this->view_data['is_new'] = false;
		$this->view_data['durc_instance_name'] = $tags_report->$name_field;
	}else{
		$this->view_data['is_new'] = true;
	}

	$debug = false;
	if($debug){
		echo '<pre>';
		var_export($this->view_data);
		exit();
	}
	

	$durc_template_results = view('DURC.tags_report.edit',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tags_report  $tags_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tags_report $tags_report){

	$tmp_tags_report = $tags_report;
			$tmp_tags_report->id = DURC::formatForStorage( 'id', 'bigint', $request->id ); 
		$tmp_tags_report->field_to_bold_in_report_display = DURC::formatForStorage( 'field_to_bold_in_report_display', 'varchar', $request->field_to_bold_in_report_display ); 
		$tmp_tags_report->field_to_hide_by_default = DURC::formatForStorage( 'field_to_hide_by_default', 'varchar', $request->field_to_hide_by_default ); 
		$tmp_tags_report->field_to_italic_in_report_display = DURC::formatForStorage( 'field_to_italic_in_report_display', 'varchar', $request->field_to_italic_in_report_display ); 
		$tmp_tags_report->field_to_right_align_in_report = DURC::formatForStorage( 'field_to_right_align_in_report', 'varchar', $request->field_to_right_align_in_report ); 
		$tmp_tags_report->field_to_bolditalic_in_report_display = DURC::formatForStorage( 'field_to_bolditalic_in_report_display', 'varchar', $request->field_to_bolditalic_in_report_display ); 
		$tmp_tags_report->numeric_field = DURC::formatForStorage( 'numeric_field', 'int', $request->numeric_field ); 
		$tmp_tags_report->decimal_field = DURC::formatForStorage( 'decimal_field', 'decimal', $request->decimal_field ); 
		$tmp_tags_report->currency_field = DURC::formatForStorage( 'currency_field', 'varchar', $request->currency_field ); 
		$tmp_tags_report->percent_field = DURC::formatForStorage( 'percent_field', 'int', $request->percent_field ); 
		$tmp_tags_report->url_field = DURC::formatForStorage( 'url_field', 'varchar', $request->url_field ); 
		$tmp_tags_report->time_field = DURC::formatForStorage( 'time_field', 'time', $request->time_field ); 
		$tmp_tags_report->date_field = DURC::formatForStorage( 'date_field', 'date', $request->date_field ); 
		$tmp_tags_report->datetime_field = DURC::formatForStorage( 'datetime_field', 'datetime', $request->datetime_field ); 
		$tmp_tags_report->save();


	$id = $tags_report->id;

	return redirect("/DURC/tags_report/$id")->with('status', 'Data Saved!');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\tags_report  $tags_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(tags_report $tags_report){
	    return tags_report::destroy( $tags_report->id );  
    }
    
    /**
     * Restore the specified resource from storage.
     * @param  $id ID of resource
     * @return \Illuminate\Http\Response
     */
    public function restore( $id )
    {
        $tags_report = tags_report::withTrashed()->find($id)->restore();
        return redirect("/DURC/test_soft_delete/$id")->with('status', 'Data Restored!');
    }
}
