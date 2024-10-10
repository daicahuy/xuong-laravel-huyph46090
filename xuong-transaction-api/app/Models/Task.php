<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_name',
        'description',
        'status',
        'project_id'
    ];

    public function project () {
        return $this->belongsTo(Project::class);
    }
}
