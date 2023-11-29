<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('profile');
});

//Route dengan Parameter (WAJIB)
// Route::get('/mahasiswa/{nama}', function ($nama = "Nur") {
//     echo "<h1>Halo nama saya $nama</h1";
// });

//Route tidak dengan Parameter (Tidak WAJIB)
// Route::get('/mahasiswa2/{nama?}', function ($nama = "Nur") {
//     echo "<h1>Halo nama saya $nama</h1";
// });

//Route dengan Parameter > 1
Route::get('/profile/{nama?}/{pekerjaan?}', function ($nama = "Nur", $pekerjaan = "Mahasiswa") {
    echo "<h1>Halo nama saya $nama kerja $pekerjaan</h1";
});

//Redirect

Route::get('/hubungi', function () {
    echo "<h1> Hubungi Kami </h1>";
})->name("Call");

Route::get('/Halo', function () {
    echo "<a href='" . route('Call') . "'>" . route('Call') . "</a>";
});

Route::prefix('/dosen')->group(function () {
    Route::get('/jadwal', function () {
        echo "<h1>Jadwal dosen</h1>";
    });
    Route::get('/materi', function () {
        echo "<h1>Materi Perkuliahan</h1>";
    });
});

Route::get('/dosen', function () {
    return view('dosen.index');
});

Route::get('/fakultas', function () {
    // return view('fakultas.index', ['ilkom' => "Fakultas Ilmu Komputer dan Rekayasa", "Fakultas Ilmu Ekonomi"]);
    // return view('fakultas.index')->with('fakultas', ['Fakultas Ilmu Komputer dan Rekayasa', 'Fakultas Ilmu Ekonomi']);

    $kampus = 'Universitas Multi Data Palembang';
    // $fakultas = ["Fakultas Ilmu Komputer dan Rekayasa", "Fakultas Ilmu Ekonomi"];
    $fakultas = [];
    return view('fakultas.index', compact('fakultas', 'kampus'));
});

Route::get('/prodi', [ProdiController::class, 'index']);

Route::resource('/kurikulum', KurikulumController::class);

Route::apiResource('/dosen', DosenController::class);

Route::get('/mahasiswa/insert', [MahasiswaController::class, 'insert']);
Route::get('/mahasiswa/update', [MahasiswaController::class, 'update']);
Route::get('/mahasiswa/delete', [MahasiswaController::class, 'delete']);
Route::get('/mahasiswa/select', [MahasiswaController::class, 'select']);

Route::get('/mahasiswa/insert-elq', [MahasiswaController::class, 'insertElq']);
Route::get('/mahasiswa/update-elq', [MahasiswaController::class, 'updateElq']);
Route::get('/mahasiswa/delete-elq', [MahasiswaController::class, 'deleteElq']);
Route::get('/mahasiswa/select-elq', [MahasiswaController::class, 'selectElq']);

Route::get('/prodi/all-join-facade', [ProdiController::class, 'allJoinFacade']);
Route::get('/prodi/all-join-elg', [ProdiController::class, 'allJoinElq']);
Route::get('/mahasiswa/all-join-elq', [MahasiswaController::class, 'allJoinElq']);

Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi.create');
Route::post('/prodi/store', [ProdiController::class, 'store']);


// metode nya get lalu masukkan namespace AuthController 
// attribute name merupakan penamaan dari route yang kita buat
// kita tinggal panggil fungsi route(name) pada layout atau controller
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');

// kita atur juga untuk middleware menggunakan group pada routing
// didalamnya terdapat group untuk mengecek kondisi login
// jika user yang login merupakan admin maka akan diarahkan ke AdminController
// jika user yang login merupakan user biasa maka akan diarahkan ke UserController
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::resource('admin', AdminController::class);
    });
    Route::group(['middleware' => ['cek_login:user']], function () {
        Route::resource('user', UserController::class);

        //
    });
    Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
    Route::get('/prodi/{prodi}', [ProdiController::class, 'show'])->name('prodi.show');
    Route::get('/prodi/{prodi}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
    Route::patch('/prodi/{prodi}', [ProdiController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/{prodi}', [ProdiController::class, 'destroy'])->name('prodi.destroy');
    //
});
