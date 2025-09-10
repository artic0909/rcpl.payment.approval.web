<?php

namespace App\Exports;

use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VendorCodeExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Get all vendors.
     */
    public function collection()
    {
        return Vendor::all();
    }

    /**
     * Define Excel headings.
     */
    public function headings(): array
    {
        return [
            'SL',
            'Site Code',
            'Vendor Code',
            'Vendor Name',
            'Vendor Category',
            'Vendor Address',
            'Vendor Account Number',
            'Vendor IFSC Code',
            'Vendor Bank Name',
            'Vendor Bank Branch Name',
            'Contact Person Name',
            'Contact Person Mobile',
            'Contact Person Email',
            'Related Product/Service',
        ];
    }

    /**
     * Map each row of vendor data.
     */
    public function map($vendor): array
    {
        static $sl = 0;
        $sl++;

        return [
            $sl,
            $vendor->state_code,
            $vendor->vendor_code,
            $vendor->vendor_name,
            is_array(json_decode($vendor->vendor_category, true))
                ? implode(', ', json_decode($vendor->vendor_category, true))
                : $vendor->vendor_category,
            $vendor->vendor_address,
            $vendor->vendor_account_number,
            $vendor->vendor_ifsc_code,
            $vendor->vendor_bank_name,
            $vendor->vendor_bank_branch_name,
            $vendor->contact_person_name,
            $vendor->contact_person_mobile,
            $vendor->contact_person_email,
            $vendor->related_product_service,
        ];
    }
}
