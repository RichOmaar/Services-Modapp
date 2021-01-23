<?php

class User extends \Illuminate\Database\Eloquent\Model {

    protected $table = "user";
    protected $primaryKey = "id_user";
    protected $hidden = ["password"];
    protected $guarded = ["password"];
    public $timestamps = false;

}