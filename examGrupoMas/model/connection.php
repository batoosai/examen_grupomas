<?php
/*
 * @Author: Manuel Romero Rivera
 * @Date: 15/06/2015
 * @Copyright: Mercury Solutions
 * @email: m.romero.rivera@hotmail.com
 */
class DatabaseConnector {
    private $connector;
    private $ready;
    private $message;

    public function __construct() {
        try {
            require dirname(__FILE__) . '/ConnectionParameters.php';
            $this->connector = new mysqli($_HOST, $_USER, $_PASS, $_DB, $_PORT);
            $this->ready = true;
        } catch (Exception $ex) {
            $this->message = $ex->getMessage();
            $this->ready = false;
        }
    }

    public function __destruct() {
        try {
            mysqli_close($this->connector);
        } catch (Exception $ex) {
            $this->message = $ex->getMessage();
        }
    }

    public function executeQueryWithResult($sqlQuery) {
        $response = false;

        try {
            if($this->ready) {
                $sqlResult = mysqli_query($this->connector, $sqlQuery);

                if(mysqli_errno($this->connector) == 0) {
                    $response = array();
                    while($row = mysqli_fetch_array($sqlResult)) {
                        $response[] = $this->cleanUpRowArray($row);
                    }
                } else {
                    $this->message = mysqli_error($this->connector);
                }
            }
        } catch (Exception $ex) {
            $this->message = $ex->getMessage();
        }

        return $response;
    }

    public function executeQueryNoResult($sqlQuery) {
        $response = false;

        try {
            if($this->ready) {
                mysqli_query($this->connector, $sqlQuery);

                if(mysqli_errno($this->connector) == 0) {
                    $response = true;
                } else {
                    $this->message = mysqli_error($this->connector);
                }
            }
        } catch (Exception $ex) {
            $this->message = $ex->getMessage();
        }

        return $response;
    }

    public function getMessage() {
        return $this->message;
    }

    private function cleanUpRowArray($array) {
        $response = array();

        try {
            if(count($array) != 0) {
                $keys = array_keys($array);

                foreach($keys as $key) {
                    if(!is_numeric($key)) {
                        $response[$key] = $array[$key];
                    }
                }
            }
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }

        return $response;
    }
    
    public function getLastId() {
        $response = 0;
        
        try {
            $response = mysqli_insert_id($this->connector);
        } catch (Exception $ex) { }
        
        return $response;
    }
}
