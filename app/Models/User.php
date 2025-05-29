<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login_token',
        'token_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'login_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'token_expires_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Gera um novo token de login para o usuário
     */
    public function generateLoginToken()
    {
        $this->login_token = Str::random(60);
        $this->token_expires_at = Carbon::now()->addHours(24); // Token expira em 24h
        $this->save();

        return $this->login_token;
    }

    /**
     * Remove o token de login do usuário
     */
    public function removeLoginToken()
    {
        $this->login_token = null;
        $this->token_expires_at = null;
        $this->save();
    }

    /**
     * Verifica se o token ainda é válido
     */
    public function isTokenValid()
    {
        return $this->login_token &&
               $this->token_expires_at &&
               Carbon::now()->isBefore($this->token_expires_at);
    }

    /**
     * Encontra usuário pelo token válido
     */
    public static function findByValidToken($token)
    {
        return self::where('login_token', $token)
                   ->where('token_expires_at', '>', Carbon::now())
                   ->first();
    }
}
