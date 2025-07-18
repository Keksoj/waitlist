<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'subscription_id'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
