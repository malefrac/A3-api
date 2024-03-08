<?php

namespace App\Models;

use Database\Seeders\EnviromentTypeSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningEnviroment extends Model
{
    use HasFactory;
    protected $table = 'learning_enviroment';
    protected $fillable = [
        'name',
        'capacity',
        'area_mt2',
        'floor',
        'inventory',
        'type_id',
        'location_id',
        'status'
    ];

    public function enviroment_type()
    {
        return $this->belongsTo(EnviromentType::class,'type_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function scheduling_enviroments()
    {
        return $this->hasMany(SchedulingEnviroment::class);
    }

}
