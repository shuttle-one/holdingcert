<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?php
class Database{
	private $db_host = DB_HOST;  // Change as required
	private $db_user = DB_USER;  // Change as required
	private $db_pass = DB_PASS;  // Change as required
	private $db_name = DB_NAME;	// Change as required

	private $con = false; // Check to see if the connection is active
	private $result = array(); // Any results from a query will be stored here
    private $myQuery = "";// used for debugging process with SQL return
    private $numResults = "";// used for returning the number of rows
	private $numRow = 0;
    private $myconn;

	public function connect(){

		if(!$this->con){

			$myconn = mysqli_connect($this->db_host,$this->db_user,$this->db_pass,$this->db_name);

            if($myconn){
                	$this->con = true;
                    $this->myconn = $myconn;

                    return true;
            }else{
                echo "Error";
                return false; // Problem connecting return FALSE
            }
        }else{
            return true; // Connection has already been made return TRUE
        }
	}

	// Function to disconnect from the database
    public function disconnect(){
    	if($this->con){
    		if($this->myconn->close()){
    			$this->con = false;
				return true;
			}else{
				return false;
			}
		}
    }

	public function sql($sql){

        $this->myQuery = $sql; // Pass back the SQL
        $query = mysqli_query($this->myconn,$sql);
		if($query){
			$this->numResults = mysqli_num_rows($query);

				for($i = 0; $i < $this->numResults; $i++){
					$r = mysqli_fetch_array($query);
               		$key = array_keys($r);
               		for($x = 0; $x < count($key); $x++){
                   		if(!is_int($key[$x])){
                   			if(mysqli_num_rows($query) >= 1){
                   				$this->result[$i][$key[$x]] = $r[$key[$x]];
							}else{
								$this->result = null;
							}
						}
					}
				}

			return true; // Query was successful
		}else{
			return false; // No rows where returned
		}
	}

	public function select($table, $rows = '*', $where = null, $order = null, $limit = null, $join = null){
		$q = 'SELECT '.$rows.' FROM '.$table;
		if($join != null){
			$q .= ' JOIN '.$join;
		}
        if($where != null){
        	$q .= ' WHERE '.$where;
		}
        if($order != null){
            $q .= ' ORDER BY '.$order;
		}
        if($limit != null){
            $q .= ' LIMIT '.$limit;
        }
        $this->myQuery = $q;
        if($this->tableExists($table)){
        	$query = @mysql_query($q);
			if($query){
				$this->numResults = mysql_num_rows($query);
				for($i = 0; $i < $this->numResults; $i++){
					$r = mysql_fetch_array($query);
                	$key = array_keys($r);
                	for($x = 0; $x < count($key); $x++){
                    	if(!is_int($key[$x])){
                    		if(mysql_num_rows($query) >= 1){
                    			$this->result[$i][$key[$x]] = $r[$key[$x]];
							}else{
								$this->result = null;
							}
						}
					}
				}
				return true;
			}else{
				array_push($this->result,mysql_error());
				return false; 
			}
      	}else{
      		return false;
    	}
    }

    public function insert($table,$params=array()){
    	 	$sql='INSERT INTO `'.$table.'` (`'.implode('`, `',array_keys($params)).'`) VALUES (\'' . implode('\', \'', $params) . '\')';

            $this->myQuery = $sql; 
            if ($ins = mysqli_query($this->myconn,$sql)) {
                $this->result = array(mysqli_insert_id($this->myconn));
                return true; 
            }else{
            	array_push($this->result,mysqli_error());
                return false;
            }
    }

    public function delete($table,$where = null){
    	 if($this->tableExists($table)){
    	 	if($where == null){
                $delete = 'DELETE '.$table;
            }else{
                $delete = 'DELETE FROM '.$table.' WHERE '.$where; 
            }
            if ($del = mysqli_query($this->myconn,$delete)) {
            	array_push($this->result,mysqli_affected_rows());
                $this->myQuery = $delete; 
                return true; 
            }else{
            	array_push($this->result,mysqli_error());
               	return false;
            }
        }else{
            return false;
        }
    }

	// Function to update row in database
    public function update($table,$params=array(),$where){
            $args=array();
			foreach($params as $field=>$value){
				$args[]=$field.'="'.$value.'"';
			}
			$sql='UPDATE '.$table.' SET '.implode(',',$args).' WHERE '.$where;

            $this->myQuery = $sql; 
            if ($query = mysqli_query($this->myconn,$sql)){
            	array_push($this->result,mysqli_affected_rows());
            	return true; 
            }else{
            	array_push($this->result,mysql_error());
                return false;
            }
    }

	private function tableExists($table){
		$tablesInDb = @mysql_query('SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');
        if($tablesInDb){
        	if(mysql_num_rows($tablesInDb)==1){
                return true; 
            }else{
            	array_push($this->result,$table." does not exist in this database");
                return false; 
            }
        }
    }

    public function getResult(){
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    public function getSql(){
        $val = $this->myQuery;
        $this->myQuery = array();
        return $val;
    }

    public function numRows(){
        $val = $this->numResults;
        return $val;
    }

	public function delResult()
	{
		unset($this->result);
		$this->results = null;
	}
}
