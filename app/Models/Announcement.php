<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model   //table annonc f db
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [     //pour db
        'user_id',
        'category_id',
        'title',
        'description',
        'type',
        'location',
        'bus_line',
        'stop_name',
        'event_date',
        'status',
        'image_path',
    ];

    /**
     * Get the attributes that should be cast. objet
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }

    
     // Get the user that owns this announcement.  chaque annonce en suivi l one user
     
    public function user(): BelongsTo   //fk user id
    {
        return $this->belongsTo(User::class);
    }

    
     // Get the category of this announcement.  chaque annonce en suivi l one category
     
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    
     // Get the reports for this announcement.  chaque annonce have plusieur reports
     
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    
     // Get messages linked to this announcement. chaque annonce have plusieur msg
     
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
