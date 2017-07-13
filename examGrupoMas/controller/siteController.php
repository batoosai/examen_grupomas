<?php

include './model/warehousesModel.php';

class SiteController {
    private $model;
    
    public function __construct() {
        $this->model = new WarehousesModel();
    }
    
    public function __destruct() {
        $this->model = null;
    }
    
    public function getWarehousesList() {
        $response = null;
        
        try {
            $response = $this->model->getWarehousesInformation();
        } catch (Exception $ex) {

        }
        
        return $response;
    }
}