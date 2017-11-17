<?php
function get_array_columns($array, $columns){

        $columns_map = array();
        for($i=0; $i<$columns; $i++){ $columns_map[] = 0; }//init columns

        //create map
        $count = count($array);
        $position = 0;
        while($count > 0){
            $columns_map[$position]++;
            $position = ($position < $columns-1) ? ++$position : 0;
            $count--;
        }

        //chunk the array based on map
        $chunked = array();
        foreach($columns_map as $map){
            $chunked[] = array_splice($array,0,$map);
        }

        return $chunked;
    }

    function obj_to_array($obj, $field){
    	if(is_array($obj)){
    		$response = array();
    		foreach($obj as $objitem){
    			if(isset($objitem->$field)){
    				$response[] = $objitem->$field;
    			}
    		}
    		return $response;
    	}else{
    		if(isset($obj->$field)){
    			$response = array();
    			$response[] = $obj->$field;
    			return $response;
    		}else{
    			return array();
    		}
    	}
    }
