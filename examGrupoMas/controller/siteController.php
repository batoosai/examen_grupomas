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
            $sourceItem = $this->itemsModel->getItemFromWarehouse($warehouseSource, $item_id);
            $destinationItem = $this->itemsModel->getItemFromWarehouse($warehouseDestination, $item_id);
            
            if($sourceItem != null) {
                $sourceNewQuantity = $sourceItem[0]["quantity"] - $quantity;
                
                if($sourceNewQuantity <= 0) {
                    $this->itemsModel->deleteFromWarehouse($item_id, $warehouseSource);
                } else {
                    $this->itemsModel->updateQuantity($warehouseSource, $item_id, $sourceNewQuantity);
                }
                
                if($destinationItem != null) {
                    $destNewQuantity = $destinationItem[0]["quantity"] + $quantity;
                    $this->itemsModel->updateQuantity($warehouseDestination, $item_id, $destNewQuantity);
                } else {
                    $this->itemsModel->insertItemInWarehouse($warehouseDestination, $item_id, $quantity);
                }
            }
        } catch (Exception $ex) {
        }
        
        return $response;
    }
    
    public function getItems() {
        $response = null;
        
        try {
            $response = $this->itemsModel->getItems();
        } catch (Exception $ex) {
        }
        
        return $response;
    }
    
    public function addItem($name, $buyPrice, $sellPrice) {
        $response = null;
        
        try {
            $response = $this->itemsModel->addNewItem($name, $buyPrice, $sellPrice);
        } catch (Exception $ex) {

        }
        
        return $response;
    }
    
    public function modifyItem($name, $buyPrice, $sellPrice, $id) {
        $response = null;
        
        try {
            $response = $this->itemsModel->modifyItem($name, $buyPrice, $sellPrice, $id);
        } catch (Exception $ex) {

        }
        
        return $response;
    }
    
    public function deleteItem($id) {
        $response = null;
        
        try {
            $response = $this->itemsModel->deleteItem($id);
        } catch (Exception $ex) {

        }
        
        return $response;
    }
    
    public function deleteFromWarehouse($warehouseId, $itemId){
        $response = null;
        
        try {
            $response = $this->itemsModel->deleteFromWarehouse($itemId, $warehouseId);
        } catch (Exception $ex) {

        }
        
        return $response;
    }
    
    public function addToWarehouse($warehouseId, $itemId, $quantity) {
        $response = null;
        
        try {
            if($quantity > 0) {
                $itemInDB = $this->itemsModel->getItemFromWarehouse($warehouseId, $itemId);
                
                if(itemInDB != null) {
                    $newQuantity = $itemInDB->quantity + $quantity;
                    $response = $this->itemsModel->updateQuantity($warehouseId, $itemId, $newQuantity);
                } else {
                    $response = $this->itemsModel->insertItemInWarehouse($warehouseId, $itemId, $quantity);    
                }
            } else {
                $response = ["status" => false, "message" => "Valor negativo"];
            }
        } catch (Exception $ex) {

        }
        
        return $response;
    }
}