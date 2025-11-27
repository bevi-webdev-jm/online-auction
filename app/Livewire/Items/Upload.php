<?php

namespace App\Livewire\Items;

use Livewire\Component;
use Livewire\WithFileUploads;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemsImport;

use App\Models\Item;
use App\Models\ItemSpecification;

class Upload extends Component
{
    use WithFileUploads;

    public $upload_file;
    public $preview = [];

    public function render()
    {
        return view('livewire.items.upload');
    }

    public function updatedUploadFile() {
        $this->preview = [];

        $item_data = new ItemsImport();
        Excel::import($item_data, $this->upload_file);
        $this->preview = $item_data->getPreviewData();
    }

    public function uploadItem() {
        foreach($this->preview as $data) {
            // check if exists
            $item = Item::where('item_number', $data['item_number'])
                ->first();
            if(!empty($item)) {
                $item->update([
                    'item_number' => $data['item_number'],
                    'name' => $data['item_name'],
                    'brand' => $data['brand']
                ]);

                ItemSpecification::where('item_id', $item->id)->forceDelete();
                foreach($data['specifications'] as $specification => $value) {
                    if(!empty($value)) {
                        $spec = new ItemSpecification([
                            'item_id' => $item->id,
                            'specification' => $specification,
                            'value' => $value
                        ]);
                        $spec->save();
                    }
                }
            } else {
                $item = new Item([
                    'item_number' => $data['item_number'],
                    'name' => $data['item_name'],
                    'brand' => $data['brand']
                ]);
                $item->save();

                foreach($data['specifications'] as $specification => $value) {
                    if(!empty($value)) {
                        $spec = new ItemSpecification([
                            'item_id' => $item->id,
                            'specification' => $specification,
                            'value' => $value
                        ]);
                        $spec->save();
                    }
                }
            }
        }

        $this->reset('preview', 'upload_file');
    }
}
