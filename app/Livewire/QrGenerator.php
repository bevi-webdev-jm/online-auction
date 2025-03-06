<?php

namespace App\Livewire;

use Livewire\Component;

use Milon\Barcode\DNS2D;

class QrGenerator extends Component
{
    public $link;
    public $size = 20;
    public $qr_link;

    public function GenerateQR() {
        $this->validate([
            'link' => [
                'required'
            ],
            'size' => [
                'required'
            ]
        ]);

        $this->qr_link = $this->link;
    }

    public function DownloadSVG() {
        $dns = new DNS2D();
        $svgContent = $dns->getBarcodeSVG($this->link, 'QRCODE', $this->size, $this->size);

        $directory = public_path('uploads/qrcodes');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = 'qrcode' . time() . '.svg';
        $filePath = $directory . '/' . $fileName;

        file_put_contents($filePath, $svgContent);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function render()
    {
        return view('livewire.qr-generator');
    }
}
