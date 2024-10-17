<?php
require_once '../include/class.pdogsb.inc.php';
$pdo = PdoGsb::getPdoGsb();
    try {
        $result = $pdo->donneInfosportabilite(1);
        var_dump($result);
        $result = $pdo->donneInfosportabilite(999);
        var_dump($result);

    } catch (Exception $e) {
        echo "Erreur lors du test : " . $e->getMessage() . "<br/>";
    }
?>
