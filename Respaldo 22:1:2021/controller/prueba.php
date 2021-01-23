<?php

include '../model/products.model.php';
include '../model/productColor.model.php';
include '../model/productPrint.model.php';
include '../model/productSize.model.php';
include '../model/measurements.model.php';
include '../model/colors.model.php';
include '../model/prints.model.php';
include '../model/storeProduct.model.php';
include '../model/features.model.php';
include '../model/articleFeatures.model.php';

class prueba {

    public function mdlPrueba(){

        $array = array();

        $array[0]['hex'] = 'ffffff';
        $array[0]['color'] = 'blanco';
        $array[1]['hex'] = '0000000';
        $array[1]['color'] = 'negro';

        return json_encode($array);
    }
    
}

           
?>
