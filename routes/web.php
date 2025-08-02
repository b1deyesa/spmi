<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\Fakultas;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/', [LoginController::class, 'post'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::middleware('auth')->group(function () {
    Route::middleware('fakultas')->group(function() {
        Route::name('form.')->prefix('form/{fakultas:id}')->namespace('App\Http\Controllers\Form')->group(function() {
            Route::get('/', 'IndexController@index')->name('index');
            Route::get('/monitoring-ipk-dan-masa-studi-lulusan/{programStudi:id}/{year}', 'MonitoringIpkDanMasaStudiLulusanController@index')->name('monitoring-ipk-dan-masa-studi-lulusan');
            Route::get('/monitoring-skor-toefl-lulusan/{programStudi:id}/{year}', 'MonitoringSkorToeflLulusanController@index')->name('monitoring-skor-toefl-lulusan');
            Route::get('/monitoring-jumlah-mahasiswa-bimbingan-akademik-dosen/{programStudi:id}/{year}', 'MonitoringJumlahMahasiswaBimbinganAkademikDosenController@index')->name('monitoring-jumlah-mahasiswa-bimbingan-akademik-dosen');
            Route::get('/monitoring-materi-dan-kehadiran-dosen-dalam-perkuliahan/{programStudi:id}/{year}', 'MonitoringMateriDanKehadiranDosenDalamPerkuliahanController@index')->name('monitoring-materi-dan-kehadiran-dosen-dalam-perkuliahan');
            Route::get('/monitoring-dosen-tetap/{programStudi:id}/{year}', 'MonitoringDosenTetapController@index')->name('monitoring-dosen-tetap');
            Route::get('/monitoring-dosen-tidak-tetap/{programStudi:id}/{year}', 'MonitoringDosenTidakTetapController@index')->name('monitoring-dosen-tidak-tetap');
            Route::get('/monitoring-kinerja-dosen/{programStudi:id}/{year}', 'MonitoringKinerjaDosenController@index')->name('monitoring-kinerja-dosen');
            Route::get('/monitoring-tenaga-kependidikan/{programStudi:id}/{year}', 'MonitoringTenagaKependidikanController@index')->name('monitoring-tenaga-kependidikan');
            Route::get('/rekapitulasi-evaluasi-skor-toefl-lulusan/{programStudi:id}/{year}', 'RekapitulasiEvaluasiSkorToeflLulusanController@index')->name('rekapitulasi-evaluasi-skor-toefl-lulusan');
        });
        Route::name('dashboard.')->prefix('dashboard/{fakultas:id}')->namespace('App\Http\Controllers\Dashboard')->group(function() {
            Route::get('/', 'IndexController@index')->name('index');
            Route::prefix('penetapan-pelaksanaan')->name('penetapan-pelaksanaan.')->namespace('PenetapanPelaksanaan')->group(function() { 
                Route::get('/profil-fakultas/{year}', 'ProfilFakultasController@index')->name('profil-fakultas');
                Route::get('/pengaturan-kebijakan-spmi', 'PengaturanKebijakanSpmiController@index')->name('pengaturan-kebijakan-spmi');
                Route::prefix('standar-nasional-pendidikan-tinggi')->name('standar-nasional-pendidikan-tinggi.')->namespace('StandarNasionalPendidikanTinggi')->group(function() { 
                    Route::prefix('fakultas')->name('fakultas.')->namespace('Fakultas')->group(function() { 
                        Route::get('/profil-fakultas', 'ProfilFakultasController@index')->name('profil-fakultas');
                        Route::put('/profil-fakultas', 'ProfilFakultasController@update')->name('profil-fakultas.update');
                        Route::get('/data-terkait-standar-nasional-pendidikan-tinggi', 'DataTerkaitStandarNasionalPendidikanTinggiController@index')->name('data-terkait-standar-nasional-pendidikan-tinggi');
                        Route::get('/data-terkait-standar-penelitian', 'DataTerkaitStandarPenelitianController@index')->name('data-terkait-standar-penelitian');
                        Route::get('/data-terkait-standar-pengabdian-pada-masyarakat', 'DataTerkaitStandarPengabdianPadaMasyarakatController@index')->name('data-terkait-standar-pengabdian-pada-masyarakat');
                    });
                    Route::prefix('program-studi')->name('program-studi.')->namespace('ProgramStudi')->group(function() { 
                        Route::get('/peringkat-akreditasi', 'PeringkatAkreditasiController@index')->name('peringkat-akreditasi');
                        Route::get('/jumlah-lulusan', 'JumlahLulusanController@index')->name('jumlah-lulusan');
                        Route::get('/jumlah-mahasiswa-lulus-tepat-waktu', 'JumlahMahasiswaLulusTepatWaktuController@index')->name('jumlah-mahasiswa-lulus-tepat-waktu');
                        Route::get('/jumlah-mahasiswa-putus-studi', 'JumlahMahasiswaPutusStudiController@index')->name('jumlah-mahasiswa-putus-studi');
                        Route::get('/presentase-mahasiswa-lulus-dengan-ipk-3', 'PresentaseMahasiswaLulusDenganIpk3Controller@index')->name('presentase-mahasiswa-lulus-dengan-ipk-3');
                        Route::get('/program-doktor', 'ProgramDoktorController@index')->name('program-doktor');
                        Route::get('/program-magister', 'ProgramMagisterController@index')->name('program-magister');
                        Route::get('/presentase-mahasiswa-lulus-dengan-ipk-2', 'PresentaseMahasiswaLulusDenganIpk2Controller@index')->name('presentase-mahasiswa-lulus-dengan-ipk-2');
                        Route::get('/program-sarjana-sarjana-terapan', 'ProgramSarjanaSarjanaTerapanController@index')->name('program-sarjana-sarjana-terapan');
                        Route::get('/program-diploma', 'ProgramDiplomaController@index')->name('program-diploma');
                        Route::get('/program-profesi', 'ProgramProfesiController@index')->name('program-profesi');
                        Route::get('/proses-pembelajaran', 'ProsesPembelajaranController@index')->name('proses-pembelajaran');
                        Route::get('/penilaian-pembelajaran', 'PenilaianPembelajaranController@index')->name('penilaian-pembelajaran');
                        Route::get('/jumlah-dosen', 'JumlahDosenController@index')->name('jumlah-dosen');
                    });
                });
                Route::get('/standar-yang-ditetapkan-institusi', 'StandarYangDitetapkanInstitusiController@index')->name('standar-yang-ditetapkan-institusi');
            });
            Route::get('/evaluasi-pengendalian-peningkatan', 'EvaluasiPengendalianPeningkatanController@index')->name('evaluasi-pengendalian-peningkatan');
        });
    });
    Route::name('setting.')->prefix('setting')->namespace('App\Http\Controllers\Setting')->group(function() {
        Route::get('/', 'IndexController@index')->name('index');
        Route::resource('fakultas', 'FakultasController');
        Route::resource('program-studi', 'ProgramStudiController');
        Route::resource('user', 'UserController');
    });
});