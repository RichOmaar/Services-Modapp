<?php


class Product extends \Illuminate\Database\Eloquent\Model {
    protected $table = "products";
    protected $primaryKey = "id_product";
    protected $guarded = [];
    public $timestamps = false;

}