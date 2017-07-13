<?php
include_once './controller/siteController.php';

if($_POST) {
    switch($_POST["action"]) {
        case "addItem": addItemAsync($_POST);
            break;
        case "modifyItem": modifyItemAsync($_POST);
            break;
        case "deleteItem": deleteItemAsync($_POST);
            break;
        case "deleteFromWarehouse": deleteItemFromWarehouseAsync($_POST);
            break;
        case "addToWarehouse": addToWarehouseAsync($_POST);
            break;
        case "transferQuantity": transferQuantityAsync($_POST);
            break;
        case "getWarehouseItems": warehouseItemsAsync($_POST);
            break;
        case "getItems": getItemsAsync($_POST);
            break;
        case "getWarehouses": getWarehousesAsync($_POST);
            break;
    }
}

function addItemAsync($request) {
    $controller = new SiteController();
    $data = $controller->addItem($request["data"]["name"], $request["data"]["buyPrice"], $request["data"]["sellPrice"]);
    echo json_encode($data);
} 

function modifyItemAsync($request){
    $controller = new SiteController();
    $data = $controller->modifyItem($request["data"]["name"], $request["data"]["buyPrice"], $request["data"]["sellPrice"], $request["data"]["id"]);
    echo json_encode($data);
}

function deleteItemAsync($request){
    $controller = new SiteController();
    $data = $controller->deleteItem($request["data"]["id"]);
    echo json_encode($data);
}

function deleteItemFromWarehouseAsync($request) {
    $controller = new SiteController();
    $data = $controller->deleteFromWarehouse($request["data"]["warehouse"], $request["data"]["item"]);
    echo json_encode($data);
}

function addToWarehouseAsync($request) {
    $controller = new SiteController();
    $data = $controller->addToWarehouse($request["data"]["warehouse"], $request["data"]["item"], $request["data"]["quantity"]);
    echo json_encode($data);
}

function transferQuantityAsync($request) {
    $controller = new SiteController();
    $data = $controller->transferProductToWarehouse($request["data"]["source"], $request["data"]["destination"], $request["data"]["item"], $request["data"]["quantity"]);
    echo json_encode($data);
}

function warehouseItemsAsync($request) {
    $controller = new SiteController();
    $data = $controller->getProductsByWarehouse($request["data"]["id"]);
    echo json_encode($data);
}

function getItemsAsync($request) {
    $controller = new SiteController();
    $data = $controller->getItems();
    echo json_encode($data);
}

function getWarehousesAsync($request) {
    $controller = new SiteController();
    $data = $controller->getWarehouses();
    echo json_encode($data);
}