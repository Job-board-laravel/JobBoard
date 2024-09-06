<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Newjob;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover_letter',
        'status',
        'applied_at',
        'job_id',
        'user_id'
        // 'resume'
    ];
    public function AppJob(){
        return $this->belongsTo(Newjob::class,'job_id', 'job_id');
    }

    public function CandidateFillApp(){
        return $this->belongsTo(User::class , 'user_id', 'user_id');
    }
    
}
