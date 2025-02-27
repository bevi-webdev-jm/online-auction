<?php

namespace App\Livewire\Items;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Validation\Rule;

use App\Models\Item;
use App\Models\ItemSpecification;
use App\Models\ItemPicture;

use Image;

class Form extends Component
{
    use WithFileUploads;

    public $type;

    public $item_number, $item_name, $brand;
    public $specifications = [];
    public $pictures;
    public $pictures_arr = [];
    public $item;

    public function SaveItem() {
        $this->validate([
            'item_number' => [
                'required',
                Rule::unique((new Item)->getTable())->ignore($this->type === 'update' ? $this->item->id : null)
            ],
            'item_name' => [
                'required'
            ],
            'brand' => [
                'required'
            ],
            'specifications' => [
                'required'
            ],
        ]);

        if($this->type == 'create') {
            $item = Item::create([
                'item_number' => $this->item_number,
                'name' => $this->item_name,
                'brand' => $this->brand
            ]);

            foreach ($this->specifications as $specification) {
                ItemSpecification::create([
                    'item_id' => $item->id,
                    'specification' => $specification['specification'],
                    'value' => $specification['value']
                ]);
            }

            if (!empty($this->pictures_arr)) {
                foreach ($this->pictures_arr as $key => $picture) {
                    $path = $this->SaveImage($picture['picture'], $item->id, $key);
                    ItemPicture::create([
                        'item_id' => $item->id,
                        'title' => $picture['title'],
                        'path' => $path
                    ]);
                }
            }

            // logs
            activity('created')
                ->performedOn($item)
                ->log(':causer.name has created an item :subject.name');

            // redirect
            return redirect()->route('item.index')->with([
                'message_success' => 'Item '.$item->name.' has been created successfully.'
            ]);

        } else if($this->type == 'update') {

            $changes_arr['old'] = $this->item->getOriginal();

            $this->item->update([
                'item_number' => $this->item_number,
                'name' => $this->item_name,
                'brand' => $this->brand
            ]);

            $changes_arr['changes'] = $this->item->getChanges();

            foreach ($this->specifications as $specification) {
                if (isset($specification['id']) && $specification['id']) {
                    ItemSpecification::find($specification['id'])->update([
                        'specification' => $specification['specification'],
                        'value' => $specification['value']
                    ]);
                } else {
                    ItemSpecification::create([
                        'item_id' => $this->item->id,
                        'specification' => $specification['specification'],
                        'value' => $specification['value']
                    ]);
                }
            }

            if (!empty($this->pictures_arr)) {
                // Step 1: Delete old pictures from database and storage
                $oldPictures = ItemPicture::where('item_id', $this->item->id)->get();
                foreach ($oldPictures as $oldPicture) {
                    $largePath = public_path("{$oldPicture->path}/large.jpg");
                    $smallPath = public_path("{$oldPicture->path}/small.jpg");

                    if (file_exists($largePath)) unlink($largePath);
                    if (file_exists($smallPath)) unlink($smallPath);
                    @rmdir(public_path($oldPicture->path)); // Remove empty directory

                    $oldPicture->forceDelete();
                }

                // Step 2: Save new pictures
                foreach ($this->pictures_arr as $key => $picture) {
                    $path = $this->SaveImage($picture['picture'], $this->item->id, $key);
                    ItemPicture::create([
                        'item_id' => $this->item->id,
                        'title' => $picture['title'],
                        'path' => $path
                    ]);
                }
            }

            // logs
            activity('updated')
                ->performedOn($this->item)
                ->withProperties($changes_arr)
                ->log(':causer.name has updated an item :subject.name');

            return redirect(request()->header('Referer'))->with([
                'message_success' => 'Item '.$this->item->name.' has been updated successfully.'
            ]);
        }
    }

    public function SaveImage($image_input, $id, $key) {
        $dir = public_path("/uploads/items/{$id}/{$key}");
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $image = Image::make($image_input);

        // Resize while maintaining aspect ratio
        $image->resize(800, 700, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save("{$dir}/large.jpg");

        $image->fit(100, 100)->save("{$dir}/small.jpg");

        return "/uploads/items/{$id}/{$key}";
    }

    public function updatedPictures() {
        $this->validate([
            'pictures.*' => 'image|max:2048',
        ]);

        foreach ($this->pictures as $picture) {
            $this->pictures_arr[] = [
                'title' => $picture->getClientOriginalName(),
                'picture' => $picture
            ];
        }
    }

    // add line for specifications
    public function AddLine() {
        $this->specifications[] = [
            'specification' => '',
            'value' => '',
            'id' => ''
        ];
    }

    // remove lines
    public function RemoveLine($type, $key) {
        if ($type == 'specifications') {
            if ($this->type == 'update' && isset($this->specifications[$key]['id'])) {
                ItemSpecification::find($this->specifications[$key]['id'])->delete();
            }
            unset($this->specifications[$key]);
        } elseif ($type == 'pictures') {
            if ($this->type == 'update') {
                $picture = ItemPicture::find($key);
                if ($picture) {
                    unlink(public_path($picture->path . '/large.jpg'));
                    unlink(public_path($picture->path . '/small.jpg'));
                    rmdir(public_path($picture->path));
                    $picture->delete();
                }
            }
        }
    }

    public function mount($type, $item = null) {
        $this->type = $type;

        if ($type == 'create') {
            $this->specifications = collect([
                'Display', 'Installed OS', 'RAM', 'Storage', 'Video Card', 'Processor', 'Issues/Condition', 'Serial #', 'Inclusions'
            ])->map(fn($spec) => ['specification' => $spec, 'value' => '', 'id' => ''])->toArray();
        } elseif ($type == 'update' && $item) {
            $this->item = $item;
            $this->item_number = $item->item_number;
            $this->item_name = $item->name;
            $this->brand = $item->brand;
            $this->specifications = $item->specifications->map(fn($spec) => [
                'specification' => $spec->specification,
                'value' => $spec->value,
                'id' => $spec->id
            ])->toArray();
        }
        
    }

    public function render()
    {
        return view('livewire.items.form');
    }
}
