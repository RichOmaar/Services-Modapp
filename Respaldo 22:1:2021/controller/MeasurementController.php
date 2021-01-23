<?php


class MeasurementController {

    public static function create($idRange, $idPartClothing, $idSize){
        if (strlen(trim($idRange)) == 0 || strlen(trim($idPartClothing)) == 0 || strlen(trim($idSize)) == 0)
            return NULL;

        $measurement = new Measurement();
        $measurement->fill(["id_range" => $idRange, "id_partsClothing" => $idPartClothing, "id_size" => $idSize]);

        try {
            $measurement->save();
            return $measurement;
        }
        catch (Exception $exception){
            return NULL;
        }
    }


}