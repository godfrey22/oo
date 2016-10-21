<?php
class Property_Type
{
	public $TYPE_ID;
	public $NAME;
	private $_conn;

	function __construct($conn)
    {
        $this->_conn =$conn;
    }

    public function find_property_type_by_id($id)
    {
    	$sql = 'SELECT * FROM property_type WHERE id =' . $id;
    	$parse = oci_parse($this->_conn, $sql);

        oci_execute($parse);
        $result = oci_fetch_assoc($parse);
        if($result)
        {
            $this->TYPE_ID = $result['ID'];
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
        $sql = "SELECT * FROM Property_type";

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