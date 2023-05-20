<?php

//include the db_conn.php
include_once('db_conn.php');


class Main{

    public function __construct(){

        $this->connObj = new Connection("localhost","root","","db_aquaguard (9)");

        $this->dbResult = $this->connObj->Conn();

        return($this->dbResult);
}
}


?>