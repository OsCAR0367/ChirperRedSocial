<?php

namespace App\Models;

use App\Events\ChirpCreated;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chirp extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'message',
    ];
    
    protected $dispatchesEvents = [
        'created' => ChirpCreated::class,
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function likes(): HasMany
    {
        return $this->hasMany(ChirpLike::class);
    }
    
    public function shares(): HasMany
    {
        return $this->hasMany(ChirpShare::class);
    }
    
    public function comments(): HasMany
    {
        return $this->hasMany(ChirpComment::class);
    }
    
    // Verificar si el usuario actual le ha dado like
    public function isLikedBy($user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
    
    // Verificar si el usuario actual lo ha compartido
    public function isSharedBy($user)
    {
        return $this->shares()->where('user_id', $user->id)->exists();
    }
    
    // Obtener conteo de likes
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
    
    // Obtener conteo de shares
    public function getSharesCountAttribute()
    {
        return $this->shares()->count();
    }
    
    // Obtener conteo de comentarios
    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }
}
