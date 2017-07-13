<?php
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
        case "addToWarehouse": addToWarehouse($_POST);
            break;
        case "transferQuantity": transferQuantity($_POST);
            break;
    }
}

function addItemAsync($request) {
    
} 

function modifyItemAsync($request){
    
}

function deleteItemAsync($request){
    
}

function deleteItemFromWarehouseAsync($request) {
    
}

function addToWarehouse($request) {
    
}

function transferQuantity($request) {
    
}