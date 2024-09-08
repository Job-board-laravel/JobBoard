<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Application;
use App\Models\Comment;

class Newjob extends Model
{
    use HasFactory;
    protected $primaryKey = 'job_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [ 
        'title', 
        'description',
         'requirement',
         'benefit', 
        'location',
         'contact_info',
         'logo', 
        'technologies',
         'work_type',
         'salary_range',
         'application_deadline', 
        'user_id',
         'category_id',
         'stutas'
        ];

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
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function getRouteKeyName()
    {
        return 'job_id';
    }

}
