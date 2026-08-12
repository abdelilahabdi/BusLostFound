<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'announcement_id',
        'body',
        'is_read',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',  // 0 or 1
        ];
    }

    
     // Get the sender user of the message.  chaque msg have one user is sender
     
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    
     // Get the receiver user of the message. chaque message have one user reciver
     
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    
     // Get the announcement linked to this message.   chaque messag lier with one annonce
     
    public function announcement(): BelongsTo
    {
        return $this->belongsTo(Announcement::class);
    }
}
