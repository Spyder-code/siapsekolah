<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SiswaImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $user = User::create([
        'username' => $row[5],
        'email' => $row[4],
        'role' => 'siswa', // Anda bisa mengganti role sesuai kebutuhan
        'password' => bcrypt($row[6]), // Anda bisa mengubah cara enkripsi password sesuai konfigurasi
      ]);
      $user;

      // Menyimpan data ke dalam tabel siswas
      $siswa = new Siswa([
          'user_id' => $user->id,
          'kelas_id' => $row[0],
          'name' => $row[3],
          'jk' => $row[7],
          'jenispendaftaran' => $row[8],
          'diterimapada' => $row[9],
          'nis' => $row[1],
          'nisn' => $row[2],
          'tempatlahir' => $row[10],
          'tanggallahir' => $row[11],
          'agama' => $row[12],
          'statusdalamkeluarga' => $row[13],
          'anak_ke' => $row[14],
          'alamat' => $row[15],
          'telepon' => $row[16],
          'namaayah' => $row[17],
          'pekerjaanayah' => $row[18],
          'namaibu' => $row[19],
          'pekerjaanibu' => $row[20],
          'namawali' => $row[21],
          'pekerjaanwali' => $row[22],
      ]);

      $siswa->save();
      return $siswa;
    }

    // Tentukan baris pertama data yang akan diimpor (misalnya, baris judul tidak diimpor)
    public function startRow(): int
    {
        return 5;
    }
}
