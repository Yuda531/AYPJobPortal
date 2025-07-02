<?php

namespace App\Exports;

use App\Models\JobApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class JobApplicantsExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    protected $job;
    protected $applications;

    public function __construct($job, $applications)
    {
        $this->job = $job;
        $this->applications = $applications;
    }

    public function collection()
    {
        return $this->applications->map(function ($app) {
            return [
                'Name' => $app->jobSeeker->user->name ?? '-',
                'Email' => $app->jobSeeker->user->email ?? '-',
                'Phone' => $app->jobSeeker->phone ?? '-',
                'Location' => $app->jobSeeker->location ?? '-',
                'Skills' => $app->jobSeeker->skills ?? '-',
                'Applied At' => Carbon::parse($app->created_at)->setTimezone('Asia/Jakarta')->format('d M Y H:i'),
                'Resume Link' => url('storage/' . $app->resume),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Location',
            'Skills',
            'Applied At',
            'Resume Link'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Judul di atas tabel
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'Applicants for: ' . $this->job->title);
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getRowDimension(1)->setRowHeight(30);
        // Header style
        $sheet->getStyle('A2:G2')->getFont()->setBold(true);
        $sheet->getStyle('A2:G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFB6D7A8');
        // Border
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:G' . $highestRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        // Auto width
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        return [];
    }

    public function title(): string
    {
        return 'Applicants';
    }
}
