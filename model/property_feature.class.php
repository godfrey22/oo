<?php
class Property_Feature
{
	public $FEATURE_ID;
	public $NAME;
	private $_conn;

	function __construct($conn)
    {
        $this->_conn =$conn;
    }

    public function find_property_feature_by_id($id)
    {
    	$sql = 'SELECT * FROM feature WHERE feature_id =' . $id;
    	$parse = oci_parse($this->_conn, $sql);

        oci_execute($parse);
        $result = oci_fetch_assoc($parse);
        if($result)
        {
            $this->FEATURE_ID = $result['FEATURE_ID'];
            $this->NAME = $result['NAME'];
            return $result;
        }
        else
        {
            return false;
        }
    }

     public function find($where)
    {
        $sql = "SELECT * FROM feature";

        // This array will hold the where clause
        $whereClause = array();
        $where = $where[0];
        foreach($where as $key => $value)
        {
            $whereClause[] = $key . "='" . $value . "'";
        }

       if(count($whereClause) > 0)
       {
           $sql .= " WHERE " . implode(' AND ', $whereClause);
       }

        $parse = oci_parse($this->_conn, $sql);
        oci_execute($parse);

        $numrows = oci_fetch_all($parse, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        if($numrows >0) {
            include_once('result.class.php');
            return new Result($results);
        }
        else
        {
            return false;
        }
    }

}