<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Application;
use App\Models\Newjob;
use App\Models\Comment;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',

    ];

    public function UserComment()
    {
        // return $this->hasMany(Comment::class, "user_id");
        return $this->hasMany(Comment::class);

    }

    public function UserApp()
    {
        // return $this->hasMany(Comment::class, "user_id");
        return $this->hasMany(Application::class);

    }

    public function UserJobs()
    {
        // return $this->hasMany(Comment::class, "user_id");
        return $this->hasMany(Newjob::class);

    }
    
    // public function (){}
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
