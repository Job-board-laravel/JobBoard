<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Newjob;

class Categorie extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_name'
    ];
    use HasFactory;
    public function CategoryJobs()
    {
        // return $this->hasMany(Comment::class, "user_id");
        return $this->hasMany(Newjob::class);

    }
}
