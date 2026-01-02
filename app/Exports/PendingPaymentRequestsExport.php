<?php

namespace App\Exports;

use App\Models\PaymentApproval;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendingPaymentRequestsExport implements FromQuery, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = PaymentApproval::with('user')
            ->where('status', 'pending');

        // Apply search filter
        if ($this->request->filled('search')) {
            $search = $this->request->search;
            $query->where(function ($q) use ($search) {
                $q->where('vendor_name', 'like', "%{$search}%")
                    ->orWhere('vendor_code', 'like', "%{$search}%")
                    ->orWhere('remarks', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('site_name', 'like', "%{$search}%")
                    ->orWhere('amount', 'like', "%{$search}%")
                    ->orWhere('payment_status', 'like', "%{$search}%")
                    ->orWhereJsonContains('request_for', $search)
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('staff_code', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('mobile', 'like', "%{$search}%");
                    });
            });
        }

        // Apply date filter
        if ($this->request->filled('date')) {
            $query->whereDate('date', $this->request->date);
        }

        // Apply date range filter (from_date and to_date)
        if ($this->request->filled('from_date') && $this->request->filled('to_date')) {
            $query->whereBetween('date', [$this->request->from_date, $this->request->to_date]);
        } elseif ($this->request->filled('from_date')) {
            $query->whereDate('date', '>=', $this->request->from_date);
        } elseif ($this->request->filled('to_date')) {
            $query->whereDate('date', '<=', $this->request->to_date);
        }

        return $query->orderBy('id', 'desc');
    }

    public function headings(): array
    {
        return [
            'Date',
            'Approval Status',
            'Payment Status',
            'Site Name',
            'Request For',
            'Item Description',
            'Amount',
            'Vendor Name',
            'Vendor Code',
            'Staff Name',
            'Staff Code',
        ];
    }

    public function map($request): array
    {
        return [
            $request->date ? $request->date->format('d M Y') : 'N/A',
            $request->status ?? 'N/A',
            $request->payment_status ?? 'N/A',
            $request->site_name ?? 'N/A',
            is_array($request->request_for) ? implode(', ', $request->request_for) : 'N/A',
            $request->item_description ?? 'N/A',
            '₹ ' . number_format($request->amount, 2),
            $request->vendor_name ?? 'N/A',
            $request->vendor_code ?? 'N/A',
            $request->user->name ?? 'N/A',
            $request->user->staff_code ?? 'N/A',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
