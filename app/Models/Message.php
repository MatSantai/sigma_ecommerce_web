<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'priority',
        'is_pinned'
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
    ];

    /**
     * Get the user who created the message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get pinned messages.
     */
    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }

    /**
     * Scope to get messages by priority.
     */
    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope to get high priority messages.
     */
    public function scopeHighPriority($query)
    {
        return $query->where('priority', 'high');
    }

    /**
     * Get priority color class for display.
     */
    public function getPriorityColorAttribute()
    {
        return match($this->priority) {
            'high' => 'bg-red-100 text-red-800',
            'medium' => 'bg-yellow-100 text-yellow-800',
            'low' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get priority icon for display.
     */
    public function getPriorityIconAttribute()
    {
        return match($this->priority) {
            'high' => 'fas fa-exclamation-triangle',
            'medium' => 'fas fa-exclamation-circle',
            'low' => 'fas fa-info-circle',
            default => 'fas fa-circle',
        };
    }
} 