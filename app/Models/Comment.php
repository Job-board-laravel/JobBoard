<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Newjob;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'comment_id';
    protected $fillable = [
        'content',
         'job_id',
         'user_id'
    ];

    public function UserCreateComment(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function JobComment(){
        return $this->belongsTo(Newjob::class, 'job_id', 'job_id');
    }

}
