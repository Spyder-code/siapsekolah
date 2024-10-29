<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      collect([
        [ //1
          'username' => 'elfinadmin',
          'email' => 'elfinadmin@gmail.com',
          'role' => 'admin',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //2
          'username' => 'erikadmin',
          'email' => 'erikadmin@gmail.com',
          'role' => 'admin',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //3
          'username' => 'budiguru',
          'email' => 'budiguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //4
          'username' => 'dewiguru',
          'email' => 'dewiguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //5
          'username' => 'iwanguru',
          'email' => 'iwanguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //6
          'username' => 'yasrifanguru',
          'email' => 'yasrifan@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //7
          'username' => 'hermanwali',
          'email' => 'herman@gmail.com',
          'role' => 'walisiswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //8
          'username' => 'yantowali',
          'email' => 'yanto@gmail.com',
          'role' => 'walisiswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //9
          'username' => 'elfansiswa',
          'email' => 'elfan@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //10
          'username' => 'mellasiswa',
          'email' => 'mella@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //11
          'username' => 'teguhsiswa',
          'email' => 'teguh@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //12
          'username' => 'alfitkasiswa',
          'email' => 'alfitka@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //13
          'username' => 'andre',
          'email' => 'andre@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //14
          'username' => 'renal',
          'email' => 'renal@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //15
          'username' => 'dimas',
          'email' => 'dimas@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //16
          'username' => 'rafli',
          'email' => 'rafli@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //17
          'username' => 'khikmal',
          'email' => 'khikmal@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //18
          'username' => 'trio',
          'email' => 'trio@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //19
          'username' => 'dwi',
          'email' => 'dwi@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //20
          'username' => 'rifaul',
          'email' => 'rifaul@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //21
          'username' => 'hadiguru',
          'email' => 'hadiguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //22
          'username' => 'indahguru',
          'email' => 'indahguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //23
          'username' => 'slametguru',
          'email' => 'slametguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //24
          'username' => 'triguru',
          'email' => 'triguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //25
          'username' => 'ahmadguru',
          'email' => 'ahmadguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
        [ //26
          'username' => 'titinguru',
          'email' => 'titinguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
          'sekolah_id' => 1,
        ],
      ])->each(function($user){
        User::create($user);
      });
    }
}
