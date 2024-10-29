<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'guru';

    // public function getUser()
    // {
    //     return $this->morphMany(User::class, 'getUser');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ekstrakurikuler()
    {
      return $this->hasMany(Ekstrakurikuler::class, 'guru_id', 'id');
    }

    public function kelas()
    {
      return $this->hasOne(Kelas::class, 'guru_id', 'id');
    }

    public function pembelajaran()
    {
      return $this->hasMany(Pembelajaran::class, 'guru_id', 'id');
    }

    protected static function booted()
    {
        parent::boot();
        static::addGlobalScope('sekolah_id', function (Builder $builder) {
            $builder->where('sekolah_id', session()->get('sekolah_id'));
        });
        static::creating(function ($model) {
            if (!$model->isDirty('sekolah_id')) {
                $model->sekolah_id = session()->get('sekolah_id');
            }
        });
    }
}
