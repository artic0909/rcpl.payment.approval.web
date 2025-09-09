<?php

namespace App\Exports;

use App\Models\SiteCode;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiteCodeExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Fetch the data
     */
    public function collection()
    {
        // Only get required columns
        return SiteCode::select('id', 'site_code', 'site_name', 'location')->get();
    }

    /**
     * Define custom headings
     */
    public function headings(): array
    {
        return [
            'SL',
            'Site Code',
            'Site Name',
            'Location',
        ];
    }

    /**
     * Map each row
     */
    public function map($siteCode): array
    {
        static $sl = 0; // to auto-increment SL number
        $sl++;

        return [
            $sl,
            $siteCode->site_code,
            $siteCode->site_name,
            $siteCode->location,
        ];
    }
}
