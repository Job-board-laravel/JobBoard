<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Newjob;

class Application extends Model
{
    use HasFactory;

    public function AppJob(){
        return $this->belongsTo(Newjob::class);
    }

    public function CandidateFillApp(){
        return $this->belongsTo(User::class);
    }
}
