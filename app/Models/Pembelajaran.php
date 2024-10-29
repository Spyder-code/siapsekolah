<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelajaran extends Model
{
    use HasFactory;

    protected $table = 'pembelajaran';
    protected $guarded = ['id'];

    public function nilaiKeterampilan()
    {
      return $this->hasMany(NilaiKeterampilan::class, 'pembelajaran_id', 'id');
    }

    public function nilaiPengetahuan()
    {
      return $this->hasMany(NilaiPengetahuan::class, 'pembelajaran_id', 'id');
    }

    public function nilaiPts()
    {
      return $this->hasMany(NilaiPts::class, 'pembelajaran_id', 'id');
    }

    public function nilaiPas()
    {
      return $this->hasMany(NilaiPas::class, 'pembelajaran_id', 'id');
    }

    public function kelas()
    {
      return $this->belongsTo(Kelas::class, 'kelas_id','id');
    }

    public function mapel()
    {
      return $this->belongsTo(Mapel::class, 'mapel_id','id');
    }

    public function guru()
    {
      return $this->belongsTo(Guru::class, 'guru_id','id');
    }

    public function nilaiakhir()
    {
      return $this->hasMany(NilaiAkhir::class, 'pembelajaran_id', 'id');
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
