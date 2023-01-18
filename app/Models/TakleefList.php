<?php

namespace App\Models;

use App\Models\Emplopyee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakleefList extends Model
{
    use HasFactory;
    protected $table = 'takleef_list';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function employee()
    {
        return $this->belongsTo(Emplopyee::class, 'employee_id');
    }
}