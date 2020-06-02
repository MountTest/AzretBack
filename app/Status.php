<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name', 'employee_id'];

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
