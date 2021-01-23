<?php


class ProductController {

    public static function createProduct($idRange, $idPartClothing, $idSize, $productName, $price, $avgDiscount,
                                         $priceDiscount, $idArticleType, $idCategory, $idGender, $idBody, $labelStyle,
                                         $labelOccasion, $idLabelSeason, $idClient, $colors){


        if (  strlen(trim($productName)) == 0   || strlen(trim($price)) == 0            || strlen(trim($idArticleType)) == 0    ||
            strlen(trim($idCategory)) == 0      || strlen(trim($idGender))  == 0        || strlen(trim($idBody)) == 0           ||
            strlen(trim($labelStyle)) == 0      || strlen(trim($labelOccasion)) == 0    || strlen(trim($idLabelSeason)) == 0    ||
            strlen(trim($idClient)) == 0){
            return ["success" => false, "status" => CConstants::STATUS_ERROR, "message" => "Parámetros no pueden estar vacíos.", "code" => 400];
        }

        // 1. Insertar registro de Measurement
        $measurement = MeasurementController::create($idRange, $idPartClothing, $idSize);
        if ($measurement == NULL){
            return ["success" => false, "status" => CConstants::STATUS_ERROR, "message" => "No se pudo guardar medida.", "code" => 400];
        }

        if ($avgDiscount === '')    $avgDiscount = NULL;
        if ($priceDiscount === '')  $priceDiscount = NULL;

        // 2. Insertar Producto
       $product = new Product();
       $product->fill(["productName" => $productName, "price" => $price, "avgDiscount" => $avgDiscount,
           "priceDiscount" => $priceDiscount, "id_articleType" => $idArticleType, "id_category" => $idCategory,
           "id_gender" => $idGender, "id_body" => $idBody, "labelStyle" => $labelStyle, "labelOccasion" => $labelOccasion,
           "id_labelSeason" => $idLabelSeason, "id_client" => $idClient, "id_measurement" => $measurement->id_measurement]
       ); // id_measurement = id del registro insertado en (1.)

       try {
           $product->save();  // al guardarse se actualiza automáticamente su id
       }
       catch (Exception $exception){
           // si no se pudo guardar el producto, eliminar medida insertada anteriormente
           $measurement->delete();

           return ["success" => false, "status" => CConstants::STATUS_ERROR, "message" => "Error al guardar producto.", "code" => 400];
       }

       // 3. Crear cada color así como product_color los cuales son recibidos como un json
        $colors = json_decode($colors, true);

       if ($colors != NULL){
           $insertedColors = [];
           $insertedProductColors = [];

           foreach($colors as $c){
               $color = new Color();
               $color->fill(["colorName" => $c["color"], "hex" => $c["hex"]]);

               $productColor = new ProductColor();
               $productColor->id_product = $product->id_product;

               try {
                   $color->save();
                   $productColor->id_color = $color->id_color;
                   $productColor->save();
                   array_push($insertedColors, $color);
                   array_push($insertedProductColors, $productColor);
               }
               catch (Exception $exception){
                   // no se pudo insertar color, se podría omitir el error y seguir con el registro
                   // o como en este ejemplo, se cancela la inserción de producto y se eliminan todos los registros
                   // insertados hasta ahora

                   $measurement->delete();
                   $product->delete();

                   foreach ($insertedProductColors as $productColor){
                       $productColor->delete();
                   }
                   foreach ($insertedColors as $color){
                       $color->delete();
                   }


                   return ["success" => false, "status" => CConstants::STATUS_ERROR, "message" => "Error al guardar producto.", "code" => 400];
               }

           }
       }

        return ["success" => true, "status" => CConstants::STATUS_OK, "message" => "Producto guardado.", "code" => 200];
    }


}