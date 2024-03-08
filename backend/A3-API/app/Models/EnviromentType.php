<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnviromentType extends Model
{
    use HasFactory;
    protected $table = 'enviroment_type';
    protected $fillable = [
        'description',
    ];

    public function learning_enviroments()
    {
        return $this->hasMany(LearningEnviroment::class);
    }
}
