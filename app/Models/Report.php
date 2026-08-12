<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [     //annonce
        'user_id',
        'announcement_id',
        'reason',
        'status',  // pending or reviewed
    ];

    
     // Get the user who submitted this report.  chaque report traiter men one user
     
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
      // Get the announcement that was reported.  chaque report suivi en one annonce
     
    public function announcement(): BelongsTo
    {
        return $this->belongsTo(Announcement::class);
    }
}
