<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'ekstrakurikuler';

    public function anggotaEkskul()
    {
      return $this->hasMany(AnggotaEkskul::class, 'ekstrakurikuler_id', 'id');
    }

    public function guru()
    {
      return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

    public function tapel()
    {
      return $this->belongsTo(Tapel::class, 'tapel_id', 'id');
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
