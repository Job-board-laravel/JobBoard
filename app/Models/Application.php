<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Newjob;
use Illuminate\Database\Eloquent\SoftDeletes;


class Application extends Model
{
    use HasFactory,SoftDeletes;
    use SoftDeletes;
    protected $table = 'applications';
    protected $primaryKey = 'application_id';

    protected $fillable = [
        'cover_letter',
        'status',
        'applied_at',
        'job_id',
        'user_id',
        'name',
        'phone',
        'email'
    ];
    public function AppJob()
    {
        return $this->belongsTo(Newjob::class, 'job_id', 'job_id');
    }

    public function CandidateFillApp()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


    // public function scopeActive($query)
    // {
    //     return $query->where('is_deleted', false);
    // }

    // // Scope to get deleted records
    // public function scopeTrashed($query)
    // {
    //     return $query->where('is_deleted', true);
    // }


}
