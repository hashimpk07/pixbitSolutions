<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','joining_date','dob','gender','mobile','phone','email','present_address','permenant_address','same_address','status','image','resume','designation_id',
    ];
    public function designations()
    {
        return $this->hasOne(designations::class,'id','designation_id');
    }
}
