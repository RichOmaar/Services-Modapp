<?php


class PersonalMeasurement extends \Illuminate\Database\Eloquent\Model{

    protected $table = "personal_measurements";
    protected $primaryKey = "user_id";
    protected $guarded = [];
    public $timestamps = false;


}