<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Students extends Model
{
    use HasFactory;

    protected $fillable = [
        "firstName",
        "lastName",
        "gender",
        "dateOfBirth",
        "contactNumber",
        "email",
        "address",
        "enrollmentDate",
        "userId",
    ];

    public function users()
    {
        return $this->belongsTo(Users::class ,'userId', 'userId'); 
    }
}
