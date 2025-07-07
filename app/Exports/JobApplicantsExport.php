<?php

namespace App\Exports;

use App\Models\JobApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class JobApplicantsExport implements FromCollection, WithHeadings, WithStyles, WithTitle, WithMapping, WithCustomStartCell
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
        return $this->applications;
    }

    public function startCell(): string
    {
        // Mulai heading di baris ke-5
        return 'A5';
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

    public function map($app): array
    {
        return [
            $app->jobSeeker->user->name ?? '-',
            $app->jobSeeker->user->email ?? '-',
            $app->jobSeeker->phone ?? '-',
            $app->jobSeeker->location ?? '-',
            $app->jobSeeker->skills ?? '-',
            \Carbon\Carbon::parse($app->created_at)->setTimezone('Asia/Jakarta')->format('d M Y H:i'),
            url('storage/' . $app->resume),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Heading dan subheading
        $sheet->setCellValue('A1', 'Applicant For: ' . $this->job->title);
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(18);
        $sheet->getRowDimension(1)->setRowHeight(32);

        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', 'Company: ' . ($this->job->employer->company_name ?? '-'));
        $sheet->getStyle('A2')->getFont()->setItalic(true)->setSize(13);
        $sheet->getRowDimension(2)->setRowHeight(22);

        $sheet->mergeCells('A3:G3');
        $sheet->setCellValue('A3', 'Export Date: ' . now('Asia/Jakarta')->format('d M Y H:i') . ' WIB');
        $sheet->getStyle('A3')->getFont()->setSize(12);
        $sheet->getRowDimension(3)->setRowHeight(20);

        // Garis pemisah
        $sheet->mergeCells('A4:G4');
        $sheet->setCellValue('A4', str_repeat('-', 80));
        $sheet->getStyle('A4')->getFont()->setSize(10);

        // Header style (baris ke-5)
        $sheet->getStyle('A5:G5')->getFont()->setBold(true);
        $sheet->getStyle('A5:G5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFB6D7A8');
        // Border
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A5:G' . $highestRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
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
