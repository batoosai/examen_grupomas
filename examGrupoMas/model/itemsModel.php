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
            $sql .= " FROM items, items_warehouse";
            $sql .= " WHERE items.id = items_warehouse.item_id";
            $sql .= " AND items_warehouse.warehouse_id = $warehouseId";
            
            $sql = $this->executeQueryWithResult($sql);
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
        } catch (Exception $ex) {
            $response["message"] = $ex->getMessage();
        }
        
        return $response;
    }
    
    public function modifyItem($name, $buyPrice, $sellPrice, $id) {
        $response = ["status" => false, "message" => ""];
        
        return $response;
    }
}