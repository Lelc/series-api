<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'season', 'episode', 'watched', 'series_id'
    ];

    protected $appends = ['links'];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function getWatchedAttribute($watched): bool
    {
        return $watched;
    }

    public function getLinksAttribute(): array
    {
        return [
            'self' => "/api/episodes/$this->id",
            'serie' => "/api/series/$this->series_id"
        ];
    }
}
