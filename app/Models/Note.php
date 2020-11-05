<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    /**
     * Make attributes that are mass assignable. This is required
     * for integration with livewire.
     * @var array
     */
    protected $fillable = [
        'title', 'content'
    ];

    /**
     * Returns a Relation that describes the User that
     * owns this note.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
