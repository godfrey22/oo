<?php
class Property
{
	public $ID;
	public $STREET;
	public $STATE;
	public $POSTCODE;
	public $TYPE_ID;
	public $SUBURB;
	private $_conn
	function __construct($conn)
    {
        $this->_conn =$conn;
    }
    
}