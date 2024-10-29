<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'kelas';

    public function tapel()
    {
      return $this->belongsTo(Tapel::class, 'tapel_id', 'id');
    }

    public function guru()
    {
      return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

    public function pembelajaran()
    {
      return $this->hasMany(Pembelajaran::class, 'kelas_id', 'id');
    }

    public function siswa()
    {
      return $this->hasMany(Siswa::class, 'kelas_id', 'id');
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
