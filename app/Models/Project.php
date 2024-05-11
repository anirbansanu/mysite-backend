<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'img_path',
        'title',
        'badges',
        'project_link',
        'github_link',
        'desc',
    ];

    // Define any relationships if needed
}
