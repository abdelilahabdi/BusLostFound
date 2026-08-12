<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [   
        'name',   //tele or sac ...
    ];

    
     // Get the announcements that belong to this category.  chaque category have a plusieurs annonce 
     
    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }
}
