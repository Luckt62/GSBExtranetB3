<?php
if(!isset($_GET['action'])){
    $_GET['action'] = 'portabilite';
}
$action = $_GET['action'];
switch($action){
    case 'portabilite':{
        portabiliter($_SESSION['id']);
        include('vues/v_portabiliter.php');
        break;
    }
}