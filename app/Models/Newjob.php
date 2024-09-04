<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Application;

class Newjob extends Model
{
    use HasFactory;
    public function EmployeeCreateJob(){
        return $this->belongsTo(User::class);
    }

    public function JobCategory(){
        return $this->belongsTo(Categorie::class);
    }

    public function JobApps()
    {
        // return $this->hasMany(Comment::class, "user_id");
        return $this->hasMany(Application::class);

    }

}
