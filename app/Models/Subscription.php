<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'telephone', 'email', 'commentary', 'user_id', 'deletion_code'];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
