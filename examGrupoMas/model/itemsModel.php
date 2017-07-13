<?php
class ItemsModel extends DatabaseConnector {
    public function __construct() {
        parent::__construct();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function getItemsByWarehouse($warehouseId) {
        $response = ["status" => false, "data" => null, "message" => ""];
        
        try {
            $sql = "SELECT items.id, items.name, items.buyPrice, items.sellPrice";
            $sql .= " FROM items, item_warehouse";
            $sql .= " WHERE items.id = item_warehouse.item_id";
            $sql .= " AND item_warehouse.warehouse_id = $warehouseId";
            $sql .= " AND item_warehouse.active = 1";
            
            $sqlResponse = $this->executeQueryWithResult($sql);
            
            if(!$sqlResponse) {
                $response["status"] = false;
                $response["data"] = null;
                $response["message"] = $this->getMessage();
            } else{
                $response["status"] = true;
                $response["data"] = $sqlResponse;
                $response["message"] = "";
            }
        } catch (Exception $ex) {
            $response["message"] = $ex->getMessage();
        }
        
        return $response;
    }
    
    public function deleteFromWarehouse($itemId, $warehouseId) {
        $response = ["status" => false, "message" => ""];
        
        try {
            $sql = "UPDATE item_warehouse";
            $sql .= " SET active = 0";
            $sql .= " WHERE item_id = $itemId";
            $sql .= " AND warehouse_id = $warehouseId";
            
            $response["status"] = $this->executeQueryNoResult($sql);
            
            if(!$response["status"]) {
                $response["message"] = $this->getMessage();
            }
        } catch (Exception $ex) {
            $response["message"] = $ex->getMessage();
        }
        
        return $response;
    }
    
    public function getItems() {
        $response = ["status" => false, "data" => null, "message" => ""];
        
        try {
            $sql = "SELECT items.id, items.name";
            $sql .= " FROM items";
            $sql .= " WHERE items.active = 1";
            
            $sqlResponse = $this->executeQueryWithResult($sql);
            
            if(!$sqlResponse) {
                $response["data"] = $sqlResponse;
                $response["message"] = "";
                $response["status"] = true;
            } else {
                $response["data"] = null;
                $response["message"] = $this->getMessage();
                $response["status"] = false;
            }
        } catch (Exception $ex) {
            $response["message"] = $ex->getMessage();
        }
        
        return $response;
    }
    
    public function addNewItem($name, $buyPrice, $sellPrice) {
        $response = ["status" => false, "message" => ""];
        
        try {
            $sql = "INSERT INTO items(name, buyPrice, sellPrice)";
            $sql .= " VALUES('$name','$buyPrice','$sellPrice')";
            
            $response["status"] = $this->executeQueryNoResult($sql);
            
            if(!response["status"]) { 
                $response["message"] = $this->getMessage(); 
            }
        } catch (Exception $ex) {
            $response["message"] = $ex->getMessage();
        }
        
        return $response;
    }
    
    public function modifyItem($name, $buyPrice, $sellPrice, $id) {
        $response = ["status" => false, "message" => ""];
        
        try {
            $sql = "UPDATE items";
            $sql .= " SET name = '$name', buyPrice = '$buyPrice', sellPrice = '$sellPrice'";
            $sql .= " WHERE id = $id";
            
            $response["status"] = $this->executeQueryNoResult($sql);
            
            if(!$response["status"]) {
                $response["message"] = $this->getMessage();
            }
        } catch (Exception $ex) {
            $response["message"] = $ex->getMessage();
        }
        
        return $response;
    }
    
    public function deleteItem($id) {
        $response = ["status" => false, "message" => ""];
        
        try {
            $sql = "UPDATE items";
            $sql .= " SET active = 0";
            $sql .= " WHERE id = $id";
            
            $response["status"] = $this->executeQueryNoResult($sql);
            
            if(!$response["status"]) {
                $response["message"] = $this->getMessage();
            }
        } catch (Exception $ex) {
            $response["message"] = $ex->getMessage();
        }
        
        return $response;
    }
     
    
}