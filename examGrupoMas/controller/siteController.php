<?php

include './model/warehousesModel.php';
include './model/itemsModel.php';

class SiteController {
    private $warehouseModel;
    private $itemsModel;
    
    public function __construct() {
        $this->warehouseModel = new WarehousesModel();
        $this->itemsModel = new ItemsModel();
    }
    
    public function __destruct() {
        $this->model = null;
    }
    
    public function getWarehousesList() {
        $response = null;
        
        try {
            $response = $this->warehouseModel->getWarehousesInformation();
        } catch (Exception $ex) {

        }
        
        return $response;
    }
    
    public function getWarehouses() {
        $response = null;
        
        try {
            $response = $this->warehouseModel->getWarehouses();
        } catch (Exception $ex) {
        }
        
        return $response;
    }
    
    public function getProductsByWarehouse($id) {
        $response = null;
        
        try {
            $response = $this->itemsModel->getItemsByWarehouse($id);
        } catch (Exception $ex) {
        }
        
        return $response;
    }
    
    public function transferProductToWarehouse($warehouseSource, $warehouseDestination, $item_id, $quantity) {
        $response = null;
        
        try {
        } catch (Exception $ex) {
        }
        
        return $response;
    }
}