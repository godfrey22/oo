<?php
class SearchController{
	private $_conn;

	function __construct($conn)
	{
		$this->_conn=$conn;
	}

	public function getFeature(){
		include_once('model/property_feature.class.php');
		$feature = new Property_Feature($this->_conn);

		$query="SELECT * FROM feature";
        $stmt = oci_parse($this->_conn, $query);
        oci_execute($stmt); 
        $result = oci_fetch($stmt);
		if($result)
        {
        	$feature_result = array();
        	while(oci_fetch($stmt))
        	{
        		$feature_result[oci_result($stmt, 1)]=oci_result($stmt, 2);
        	}
            return $feature_result;
        }
        else
        {
            return false;
        }
	}

	public function getType(){
		include_once('model/property_type.class.php');
		$type = new Property_Type($this->_conn);

		$query="SELECT * FROM property_type";
        $stmt = oci_parse($this->_conn, $query);
        oci_execute($stmt); 
        $result = oci_fetch($stmt);
		if($result)
        {
        	$type_result = array();
        	while(oci_fetch($stmt))
        	{
        		$type_result[oci_result($stmt, 1)]=oci_result($stmt, 2);
        	}
            return $type_result;
        }
        else
        {
            return false;
        }
	}
	
}