<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable = [
        'type',
        'img_path',
        'title',
        'badges',
        'project_link',
        'github_link',
        'desc',
    ];
    protected $casts = [
        'type' => 'array',
        'badges' => 'array',
    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('project_images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/svg+xml', 'image/gif'])
            ->maxFilesize(10 * 1024 * 1024); // Max 10MB file size
    }
    public function getImageAttribute()
    {
        $media = $this->getFirstMedia('project_images');

        if ($media) {
            return $media->getUrl();
        }

        // Return a default image URL or null if no image is found
        return null;
    }

    public function getImageCaptionAttribute()
    {
        $media = $this->getFirstMedia('project_images');

        if ($media) {
            return $media->getCustomProperty('caption'); // Assuming you have a 'caption' custom property
        }

        // Return a default caption or null if no image is found
        return null;
    }

}
