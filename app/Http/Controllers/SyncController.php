<?php

namespace App\Http\Controllers;

use App\Jobs\SyncAccountJob;
use App\Models\Admin;
use App\Models\Sekolah;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SyncController extends Controller
{
    public function account()
    {

        $sekolah = DB::connection('siapsapa')->table('tb_gudep')->get();
        foreach ($sekolah->chunk(50) as $index => $item) {
            dispatch(new SyncAccountJob($item));
        }

        return response([
            'code' => 200,
            'message' => 'success',
            'data' => [],
        ]);
    }
    public function accountSekolah()
    {
        $id = request('id');
        $sekolah = DB::connection('siapsapa')->table('tb_gudep')->where('id', $id)->first();
        $cek = Sekolah::where('npsn', $sekolah->npsn)->first();
        if ($cek) {
            return response([
                'code' => 200,
                'message' => 'success',
                'data' => $cek,
            ]);
        }

        $sek = Sekolah::create([
            'name' => $sekolah->nama_sekolah,
            'npsn' => $sekolah->npsn,
        ]);

        $users = DB::connection('siapsapa')
        ->table('tb_anggota')
        ->join('users', 'users.id', 'tb_anggota.user_id')
        ->where('tb_anggota.gudep', $id)
            ->where('users.role', 'gudep')
            ->select('tb_anggota.*', 'users.email as email_user', 'users.password as password_user')
            ->get();
        foreach ($users as $index => $a) {
            $cek_existt_email  = User::where('email', $a->email_user)->first();
            if (!$cek_existt_email) {
                $user = User::create([
                    'sekolah_id' => $sek->id,
                    'username' => $a->nik,
                    'email' => $a->email_user,
                    'role' => 'admin',
                    'password' => $a->password_user,
                ]);

                Admin::create([
                    'user_id' => $user->id,
                    'sekolah_id' => $sek->id,
                    'name' => $a->nama,
                    'jk' => $a->jk,
                    'tempatlahir' => $a->tempat_lahir,
                    'tanggallahir' => ($this->isValidDate($a->tgl_lahir) ? $a->tgl_lahir : null),
                    'telepon' => $a->nohp,
                    'alamat' => $a->alamat,
                    'foto' => $a->foto,
                ]);
            }
        }
        return response([
            'code' => 200,
            'message' => 'success',
            'data' => $sek,
        ]);
    }

    private function isValidDate($date)
    {
        $dateTime = DateTime::createFromFormat('Y-m-d', $date);
        return $dateTime && $dateTime->format('Y-m-d') === $date;
    }
}
