<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchedulingEnviroment extends Model
{
    use HasFactory;
    protected $table = 'scheduling_enviroment';
    protected $fillable = 
    [
        'course_id',
        'instructor_id',
        'date_scheduling',
        'initial_hour',
        'final_hour',
        'enviroment_id'
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }
    public function learning_enviroment()
    {
        return $this->belongsTo(LearningEnviroment::class, 'enviroment_id');
    }
}