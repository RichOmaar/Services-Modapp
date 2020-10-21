<?php

class modelPrueba {
    public function mdlPruebaColor() {

        $array = array();

        $array[0]['hex'] = 'ffffff';
        $array[0]['color'] = 'blanco';
        $array[1]['hex'] = '0000000';
        $array[1]['color'] = 'negro';

        return json_encode($array);
    }

    public function mdlPruebaPrint() {

        $array = array();

        $array[0]['name'] = 'Animal Print';
        $array[1]['name'] = 'Print Animal';

        return json_encode ($array);

    }
}

?>
