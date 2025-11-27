<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

class ItemsImport implements ToArray
{
    private $headers = [];

    private $previewData = [];

    public function array(array $rows) {
        if (empty($this->headers)) {
            $this->headers = array_shift($rows);
        }

        foreach ($rows as $row) {

            if (empty(array_filter($row))) {
                continue;
            }

            $item_number = $row[0] ?? null;
            $item_name = $row[1] ?? null;
            $brand = $row[2] ?? null;

            $count = count($row);

            $specifications_arr = [];

            for($i = 3; $i < $count - 2; $i++) {
                if (isset($this->headers[$i])) {
                    $header_key = $this->headers[$i];
                    $specifications_arr[$header_key] = $row[$i];
                }
            }

            $this->previewData[] = [
                'item_number' => $item_number,
                'item_name' => $item_name,
                'brand' => $brand,
                'specifications' => $specifications_arr,
            ];
        }
    }

    public function getPreviewData(): array {
        return $this->previewData;
    }
}
