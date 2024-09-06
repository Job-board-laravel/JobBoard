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
    protected $table = 'newjobs';
    protected $primaryKey = 'job_id';
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
        ];

    public function EmployeeCreateJob(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function JobCategory(){
        return $this->belongsTo(Categorie::class, 'category_id', 'category_id');
    }

    public function JobApps()
    {
        // return $this->hasMany(Comment::class, "user_id");
        return $this->hasMany(Application::class);

    }

}
