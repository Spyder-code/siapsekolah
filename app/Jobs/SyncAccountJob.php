<?php

namespace App\Jobs;

use App\Models\Admin;
use App\Models\Sekolah;
use App\Models\User;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SyncAccountJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $key => $item) {
            $cek_sekolah = Sekolah::where('npsn', $item->npsn)->first();
            if (!$cek_sekolah) {
                $sek = Sekolah::create([
                    'name' => $item->nama_sekolah,
                    'npsn' => $item->npsn,
                ]);
            }

            $users = DB::connection('siapsapa')
                ->table('tb_anggota')
                ->join('users', 'users.id', 'tb_anggota.user_id')
                ->where('tb_anggota.gudep', $item->id)
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
        }
    }

    private function isValidDate($date)
    {
        $dateTime = DateTime::createFromFormat('Y-m-d', $date);
        return $dateTime && $dateTime->format('Y-m-d') === $date;
    }
}
