<?php

class Pegawai
{
    // Inisialisasi awal
    // variabel : nip, nama, jabatan, agama, status
    public $nip;
    public $nama;
    public $jabatan;
    public $agama;
    public $status;
    // Const & Static
    static $no = 0;
    const PT = 'PT. Pembasmi Perselingkuhan';


    // konstruktor (nip, nama, jabatan, agama, status)
    public function __construct($nip, $nama, $jabatan, $agama, $status)
    {
        // Inisialisasi
        $this->nip = $nip;
        $this->nama = $nama;
        $this->jabatan = $jabatan;
        $this->agama = $agama;
        $this->status = $status;
        self::$no++;
    }

    public function setGajiPokok()
    {
        // setGajiPokok (gunakan switch case : manager=>15jt, asmen=>10jt, kabag=>7jt, staff=>4jt)
        switch ($this->jabatan) {
            case 'Manager':
                $gajiPokok = 15 * 1000000;
                break;
            case 'Asmen':
                $gajiPokok = 10 * 1000000;
                break;
            case 'Kabag':
                $gajiPokok = 7 * 1000000;
                break;
            case 'Staff':
                $gajiPokok = 4 * 1000000;
                break;
            default:
                $gajiPokok = 0;
                break;
        }
        return $gajiPokok;
    }

    public function setTunjab()
    {
        // setTunjab = 20% dari Gaji Pokok
        $tunJab = 20 / 100 * $this->setGajiPokok();
        return $tunJab;
    }

    public function setTunkel()
    {
        // setTunkel= 10% dari Gaji Pokok untuk sudah menikah (ternary)
        $tunKel = ($this->status == 'Menikah') ? $this->setGajiPokok() * 10 / 100 : 0;
        return $tunKel;
    }

    public function setGajiKotor()
    {
        $gajiKotor = $this->setGajiPokok() + $this->setTunjab() + $this->setTunkel();
        return $gajiKotor;
    }

    public function setZakatProfesi()
    {
        // setZakatProfesi= 2,5% dari GajiPokok untuk muslim dan Gaji Kotor minimal 6jt
        $zakat = ($this->agama == 'Islam' && $this->setGajiPokok() >= 6 * 1000000) ? ($this->setGajiPokok() * 2.5 / 100) : 0;
        return $zakat;
    }


    public function setGajiBersih()
    {
        $gajiBersih = $this->setGajiKotor() - $this->setZakatProfesi();
        return $gajiBersih;
    }

    public function cetak()
    {
        // mencetak => nip, nama, jabatan, agama, status, Gaji Pokok, Tunj Jab, Tunkel, Zakat, Gaji Bersih 
        // echo Pegawai::PT . '<br>';
        // echo 'No.' . self::$no . '<br>';
        // echo 'NIP : ' . $this->nip . '<br>';
        // echo 'Nama : ' . $this->nama  . '<br>';
        // echo 'Agama : ' . $this->agama  . '<br>';
        // echo 'Jabatan: ' . $this->jabatan . '<br>';
        // echo 'Status : ' . $this->status  . '<br>';
        // echo 'Gaji Pokok : Rp.' . number_format(2, ',', '.') . '<br>';
        // echo 'Tunjangan Jabatan : Rp.' . number_format($this->setTunjab(), 2, ',', '.') . '<br>';
        // echo 'Tunjangan Keluarga : Rp.' . number_format($this->setTunkel(), 2, ',', '.') . '<br>';
        // echo 'Zakat : Rp.' . number_format($this->setZakatProfesi(), 2, ',', '.') . '<br>';
        // echo 'Gaji Kotor : Rp.' . number_format($this->setGajiKotor(), 2, ',', '.') . '<br>';
        // echo 'Gaji Bersih : Rp.' . number_format($this->setGajiBersih(), 2, ',', '.') . '<br>' . '<br>';

        echo '
        <div class="col mb-3 mx-0">
            <div class="card" style="width: 18.9rem;">
            <h5 class="card-title text-center text-light p-1 mb-0 bg-success small">No. ' . self::$no . '</h5>
                <div class="card-body">
                    <h5 class="card-title mt-0">' . $this->nama . '</h5>
                    <h6 class="card-subtitle mb-2 text-muted">' . $this->nip . ' | ' . $this->jabatan . '</h6>
                    <p class="card-text">
                    <hr class="border border-success border-1 opacity-100 mb-3 mt-0 my-0">
                        Agama: ' . $this->agama . ' <br>
                        Status: ' . $this->status . ' <br>
                        Gaji Pokok: Rp.' . number_format($this->setGajiPokok(), 2, ',', '.') . '<br>
                        Tunjangan Jabatan: Rp.' . number_format($this->setTunjab(), 2, ',', '.') . '<br>
                        Tunjangan Keluarga: Rp.' . number_format($this->setTunkel(), 2, ',', '.') . ' <br>
                        Zakat: Rp.' . number_format($this->setZakatProfesi(), 2, ',', '.') . ' <br>
                        Gaji Kotor: Rp.' . number_format($this->setGajiKotor(), 2, ',', '.') . ' <br>
                        Gaji Bersih: Rp.' . number_format($this->setGajiBersih(), 2, ',', '.') . '
                    </p>
                </div>
                <h5 class="card-title text-center text-light bg-dark text-muted p-1 small">' . self::PT . '</h5>
            </div>
        </div>
        ';
    }
}