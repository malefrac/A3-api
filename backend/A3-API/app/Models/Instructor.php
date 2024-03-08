<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $table = 'instructor';
    protected $fillable = [
        'document',
        'fullname',
        'sena_email',
        'personal_email',
        'phone',
        'password',
        'type',
        'profile'

    ];

    public function scheduling_enviroment()
    {
        return $this->belongsTo(SchedulingEnviroment::class);
    }

}
