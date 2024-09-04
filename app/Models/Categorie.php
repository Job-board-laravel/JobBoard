<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Newjob;

class Categorie extends Model
{
    use HasFactory;
    public function CategoryJobs()
    {
        // return $this->hasMany(Comment::class, "user_id");
        return $this->hasMany(Newjob::class);

    }
}
