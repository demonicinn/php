<?php

trait Database {
    //Connect  to database
    public function dbConnect() {
        try {
            $config = json_decode(file_get_contents(__DIR__.'/config.json'));
            $this->db = new mysqli($config->host, $config->user, $config->pass, $config->database);
            if($this->db->connect_error) {
                return $this->db->connect_error;
            }else{
                return null;
            }
        }
        catch (Throwable $e) {
            echo $e->getMessage();
        }
    }
	
	/*
    * Method to run queries on database
    */
    public function query($query) {
        try {
            $sqlQuery = new stdClass();
            $sqlQuery->error = false;
            $sqlQuery->result = null;

            $db_query = $this->db->query($query);

            if($this->db->error) {
                $sqlQuery->error = true;
                $this->sqlError($query, $this->db->error);
            }else{
                $sqlQuery->result = $db_query;
            }

            return $sqlQuery;
        }
        catch (Throwable $e) {
            echo $e->getMessage();
        }
    }

    /*
    * Escape method so we don't have to type the real escape string all the time
    */
    public function escape($string) {
        try {
            $string = strip_tags($string);
            $string = filter_var($string, FILTER_SANITIZE_STRING);
            $string = htmlspecialchars($string, ENT_QUOTES);
            $string = $this->db->real_escape_string($string);
            return $string;
        }
        catch (Throwable $e) {
            echo $e->getMessage();
        }
    }

}
?>
