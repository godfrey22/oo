<?php
class Property
{
	public $ID;
	public $STREET;
	public $STATE;
	public $POSTCODE;
	public $TYPE_ID;
	public $SUBURB;
	private $_conn;

	function __construct($conn)
    {
        $this->_conn =$conn;
    }

    public function find_property_by_id($id)
    {
    	$sql = 'SELECT * FROM property WHERE id =' . $id;
    	$parse = oci_parse($this->_conn, $sql);

        oci_execute($parse);
        $result = oci_fetch_assoc($parse);
        if($result)
        {
            $this->ID = $result['ID'];
            $this->STREET = $result['STREET'];
            $this->STATE = $result['STATE'];
            $this->POSTCODE = $result['POSTCODE'];
            $this->TYPE_ID = $result['TYPE_ID'];
            $this->SUBURB = $result['SUBURB'];
            return $result;
        }
        else
        {
            return false;
        }
    }

     public function find($where)
    {
        $sql = "SELECT * FROM Property";

        // This array will hold the where clause
        $whereClause = array();

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