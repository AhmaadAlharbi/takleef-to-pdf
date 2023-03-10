<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emplopyee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'name',
        'civilId',
        'fileNo'
    ];
    public function takleefList()
    {
        return $this->hasMany(TakleefList::class, 'user_id');
    }
}