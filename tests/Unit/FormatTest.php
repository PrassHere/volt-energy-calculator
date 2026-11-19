<?php

namespace Tests\Unit;

use App\Support\Format;
use PHPUnit\Framework\TestCase;

class FormatTest extends TestCase
{
    public function test_angka_memakai_titik_ribuan_dan_koma_desimal(): void
    {
        $this->assertSame('24', Format::angka(24));
        $this->assertSame('1.248', Format::angka(1248));
        $this->assertSame('1.248,5', Format::angka(1248.5, 1));
    }

    public function test_kwh_memakai_satuan_dan_satu_desimal(): void
    {
        $this->assertSame('1.248,0 kWh', Format::kwh(1248));
        $this->assertSame('479,4 kWh', Format::kwh(479.4));
        $this->assertSame('12,3 kWh', Format::kwh(12.345));
    }

    public function test_rupiah_tanpa_desimal_dan_tanpa_spasi(): void
    {
        $this->assertSame('Rp1.802.112', Format::rupiah(1802112));
        $this->assertSame('Rp692.254', Format::rupiah(692253.6));
        $this->assertSame('Rp1.235', Format::rupiah(1234.56));
    }

    public function test_nilai_nol(): void
    {
        $this->assertSame('0', Format::angka(0));
        $this->assertSame('0,0 kWh', Format::kwh(0));
        $this->assertSame('Rp0', Format::rupiah(0));
    }

    public function test_angka_besar(): void
    {
        $this->assertSame('Rp1.234.567.890', Format::rupiah(1234567890));
    }
}