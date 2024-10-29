<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaEkskul extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'anggota_ekskul';

    public function ekstrakurikuler()
    {
      return $this->belongsTo(Ekstrakurikuler::class, 'ekstrakurikuler_id', 'id');
    }

    public function siswa()
    {
      return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
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
