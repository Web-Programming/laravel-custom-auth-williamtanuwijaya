<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function insert()
    {
        $result = DB::insert('INSERT INTO mahasiswas (npm, nama_mahasiswa, tempat_lahir, tanggal_lahir, alamat, created_at) values (?, ?, ?, ?, ?, ?)', ['1922110006', 'Ahmad', 'Palembang', '2000-01-01', 'Jl Rajawali', now()]);
        dump($result);
    }

    public function update()
    {
        $result = DB::update('update mahasiswas set nama_mahasiswa = "Ali", updated_at = now() where npm = ?', ['1922110006']);
        dump($result);
    }

    public function delete()
    {
        $result = DB::delete('delete from mahasiswas where npm = ?', ['1922110006']);
        dump($result);
    }

    public function select()
    {
        $kampus = "Universitas Multi Data Palembang";
        $result = DB::select('select * from mahasiswas');
        // dump($result);
        return view('mahasiswa.index', ['allmahasiswa' => $result, 'kampus' => $kampus]);
    }

    public function insertElq()
    {
        // $mhs = new Mahasiswa();
        // $mhs->nama = "Nur Rachmat";
        // $mhs->npm = "2009250066";
        // $mhs->tempat_lahir = "London";
        // $mhs->tanggal_lahir = date("Y-m-d");
        // $mhs->save();
        // dump($mhs);

        // Mass Asignment
        $mhs = Mahasiswa::insert(
            // [
            //     'nama' => 'Rachmat Nur',
            //     'npm' => '2009250033',
            //     'tempat_lahir' => 'Jakarta',
            //     'tanggal_lahir' => date("Y-m-d")
            // ],
            [
                'nama' => 'Will',
                'npm' => '2009250099',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => date("Y-m-d"),
                'created_at' => now(),
                'updated_at' => now()
            ],
        );
        dump($mhs);
    }
    public function updateElq()
    {
        $mahasiswa = Mahasiswa::where('npm', '2009250044')->first();
        $mahasiswa->nama_mahasiswa = 'Ucok';
        $mahasiswa->save();
        dump($mahasiswa);
    }
    public function deleteElq()
    {
        $mahasiswa = Mahasiswa::where('npm', '2009250033')->first();
        $mahasiswa->delete();
        dump($mahasiswa);
    }
    public function selectElq()
    {
        $kampus = "Univetsitas Multi Data Palembang";
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', ['allmahasiswa' => $mahasiswa, 'kampus' => $kampus]);
    }

    public function allJoinElq(){
        $kampus = "Universitas Multi Data Palembang";
        $mahasiswas = Mahasiswa::has('prodi')->get();
        return view('mahasiswa.index', ['allmahasiswa' => $mahasiswas, 'kampus' => $kampus]);
    }
}
