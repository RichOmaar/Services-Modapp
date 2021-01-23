<?php


class Measurement extends \Illuminate\Database\Eloquent\Model {
    protected $table = "measurements";
    protected $primaryKey = "id_measurement";
    protected $guarded = [];
    public $timestamps = false;

}