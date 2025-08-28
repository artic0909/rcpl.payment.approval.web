<?php

namespace App\Exports;

use App\Models\PaymentApproval;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentRequestExport implements FromCollection, WithHeadings, WithMapping
{
    private $serial = 0;

    public function collection()
    {
        return PaymentApproval::with('user')->orderBy('id', 'desc')->get();
    }

    public function map($item): array
    {
        $this->serial++;

        $requestFor = $item->request_for;
        if (is_array($requestFor)) {
            $requestFor = implode(", ", $requestFor);
        } elseif (is_string($requestFor) && $this->isJson($requestFor)) {
            $requestFor = implode(", ", json_decode($requestFor, true));
        }

        $staffDetails = $item->user
            ? "Name: {$item->user->name}, Code: {$item->user->staff_code}, Email: {$item->user->email}, Mobile: {$item->user->mobile}"
            : 'N/A';

        return [
            $this->serial,
            $item->date ? \Carbon\Carbon::parse($item->date)->format('d M Y') : '',
            ucfirst($item->status ?? 'pending'),  
            $requestFor,
            $item->item_description ?? '',        
            '₹ ' . number_format($item->amount, 2),
            $item->remarks ?? '',               
            "Vendor Name: {$item->vendor_name}, Code: {$item->vendor_code}",
            $staffDetails,
        ];
    }

    public function headings(): array
    {
        return [
            'SL',
            'Date',
            'Status',
            'Request For',
            'Item Description',
            'Amount',
            'Remarks',
            'Vendor Details',
            'Staff Details',
        ];
    }

    private function isJson($string): bool
    {
        if (!is_string($string)) {
            return false;
        }
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }
}
