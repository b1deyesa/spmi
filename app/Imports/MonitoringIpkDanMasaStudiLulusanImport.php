<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MonitoringIpkDanMasaStudiLulusanImport implements ToModel, WithHeadingRow
{
    protected $programStudi;

    public function __construct($programStudi)
    {
        $this->programStudi = $programStudi;
    }

    public function headingRow(): int
    {
        return 4; // Sesuaikan dengan posisi heading di file Excel
    }

    /**
     * Konversi nilai Excel (serial number atau string) menjadi objek Carbon
     */
    protected function excelDateToCarbon($value)
    {
        // Jika sudah berupa objek tanggal
        if ($value instanceof \DateTimeInterface) {
            return Carbon::instance($value);
        }

        // Jika berupa angka serial Excel
        if (is_numeric($value)) {
            return Carbon::createFromDate(1899, 12, 30)->addDays((int)$value);
        }

        // Coba parse string sebagai tanggal biasa
        return Carbon::parse($value);
    }

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (empty(array_filter($row))) {
            return null; // Abaikan baris kosong
        }

        // Konversi tanggal lulus
        $tanggalLulus = $this->excelDateToCarbon($row['tanggal_lulus']);

        // Hitung tanggal masuk dari lama studi
        $tanggalMasuk = $tanggalLulus->copy()
            ->subYears((int)$row['lama_studi'])
            ->startOfYear();

        // Simpan atau update data mahasiswa
        Mahasiswa::updateOrCreate(
            ['nim' => $row['nim']],
            [
                'program_studi_id' => $this->programStudi->id,
                'nama' => $row['nama_lulusan'],
                'ipk' => str_replace(',', '.', $row['ipk']),
                'tanggal_masuk' => $tanggalMasuk->format('Y-m-d'),
                'tanggal_lulus' => $tanggalLulus->format('Y-m-d'),
            ]
        );

        return null;
    }
}