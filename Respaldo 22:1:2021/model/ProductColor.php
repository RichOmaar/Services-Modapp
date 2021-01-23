<?php


class ProductColor extends \Illuminate\Database\Eloquent\Model {
    protected $table = "product_color";
    protected $primaryKey = "id_product";
    protected $guarded = [];

    public $timestamps = false;
    public $incrementing = false;
}