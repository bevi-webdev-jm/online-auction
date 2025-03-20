<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;

use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Illuminate\Support\Collection;

class AuctionExport implements FromCollection, ShouldAutoSize, WithStyles, WithProperties, WithBackgroundColor, WithStrictNullComparison, WithChunkReading
{
    public $auction;

    public function __construct($auction) {
        $this->auction = $auction;
    }
    
    public function chunkSize(): int
    {
        return 200; // Number of rows per chunk
    }

    public function batchSize(): int
    {
        return 200; // Number of rows per batch
    }

    public function backgroundColor()
    {
        return null;
    }

    public function properties(): array
    {
        return [
            'creator'        => 'Online Auction',
            'lastModifiedBy' => 'Online Auction Web System',
            'title'          => 'Online Auction details',
            'description'    => 'Auction details and list of bidders',
            'subject'        => 'Auction Details',
            'keywords'       => 'Online Auction Details,export,spreadsheet',
            'category'       => 'Auction Details',
            'manager'        => 'Online Auction Application',
            'company'        => 'BEVI',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $headerRow = count($this->auction->item->specifications) + 11; // Dynamically determine header row

        // Merge cells for the title (first row) and section title (second row)
        $sheet->mergeCells('A1:C1'); // Title row
        $sheet->mergeCells('A6:C6'); // Item details header
        $sheet->mergeCells('A'.($headerRow - 1).':C'.($headerRow - 1));

        return [
            // Title row (merged across A1 to C1)
            1 => [
                'font' => ['bold' => true, 'size' => 15],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => 'E7FDEC']
                ]
            ],
            // Item details header row (merged across A2 to C2)
            6 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => 'ddfffd']
                ]
            ],
            $headerRow - 1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['argb' => 'FFFFFF']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => '09B9C6']
                ]
            ],
            // Header row for the bidder list
            $headerRow => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['argb' => 'FFFFFF']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => '0073e6'] // Light blue background
                ]
            ]
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $auction_data = [
            ['AUCTION CODE', $this->auction->auction_code],
            ['START', $this->auction->start.' '.$this->auction->start_time],
            ['END', $this->auction->end.' '.$this->auction->end_time],
            ['MIN BID AMOUNT', number_format($this->auction->min_bid, 2)],
        ];
    
        $item = $this->auction->item;
        $item_data = [
            ['ITEM NUMBER', $item->item_number],
            ['NAME', $item->name],
            ['BRAND', $item->brand]
        ];
        
        foreach ($item->specifications as $specification) {
            $item_data[] = [
                $specification->specification,
                $specification->value
            ];
        }

        $header = [
            ['NAME', 'BID AMOUNT', 'TIMESTAMP']
        ];
        $data = [];
        $biddings = $this->auction->biddings()
            ->orderBy('bid_amount', 'DESC')
            ->orderBy('created_at', 'ASC')
            ->get();
        foreach($biddings as $bidding) {
            $data[] = [
                $bidding->user->name,
                number_format($bidding->bid_amount, 2),
                $bidding->created_at,
            ];
        }
    
        // Flatten the structure for proper row placement
        return new Collection(array_merge(
            [['ONLINE AUCTION']], // Title
            $auction_data,
            [['ITEM DETAILS']],   // Item details title
            $item_data,           // Item details data
            [['BIDDERS']],               // Empty row
            $header,              // Header row
            $data      // Bidder data
        ));
    }
}
