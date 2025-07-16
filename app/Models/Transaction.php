<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use HasFactory, Notifiable;



    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'category_id',
        'description',
        'date',
        'created_at'
    ];



    protected $casts = [
        'type' => TransactionType::class,
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
