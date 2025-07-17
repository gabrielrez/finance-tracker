<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'user_id',
        'created_at'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
