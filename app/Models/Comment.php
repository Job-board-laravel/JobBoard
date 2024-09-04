<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Newjob;

class Comment extends Model
{
    use HasFactory;

    public function UserCreateComment(){
        return $this->belongsTo(User::class);
    }

    public function JobComment(){
        return $this->belongsTo(Newjob::class);
    }

    
}
