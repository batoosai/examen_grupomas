<?php
class WarehousesModel extends DatabaseConnector {
    public function __construct() {
        parent::__construct();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function getWarehousesInformation() {
        $response = ["status" => false, "data" => [], "message" => ""];
        
        try {
            $sql = "SELECT item_warehouse.warehouse_id, warehouses.name, count(*) as noItems, IF(in_stock.elements IS NULL, 'En stock','Falta stock') as inStock";
            $sql .= " FROM warehouses";
            $sql .= " INNER JOIN item_warehouse";
            $sql .= " ON warehouses.id = item_warehouse.warehouse_id";
            $sql .= " LEFT JOIN (SELECT item_warehouse.warehouse_id, count(*) AS elements FROM item_warehouse WHERE item_warehouse.quantity < 5 AND item_warehouse.active = 1 GROUP BY item_warehouse.warehouse_id) AS in_stock";
            $sql .= " ON in_stock.warehouse_id = warehouses.id";
            $sql .= " AND warehouses.active = 1";
            $sql .= " AND item_warehouse.active = 1";
            $sql .= " GROUP BY warehouses.id, in_stock.warehouse_id";
            $sql .= " ORDER BY warehouses.name";
            
            $response["data"] = $this->executeQueryWithResult($sql);
        } catch (Exception $ex) {
            $response["message"] = $ex->getMessage();
        }
        
        return $response;
    }
}