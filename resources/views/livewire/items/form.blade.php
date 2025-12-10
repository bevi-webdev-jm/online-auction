<div>
    <div class="card">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-lg-6 align-middle">
                    <strong class="text-lg">{{$type == 'create' ? 'NEW' : 'UPDATE'}} ITEM</strong>
                </div>
                <div class="col-lg-6 text-right">
                    <a href="{{route('item.index')}}" class="btn btn-secondary btn-xs">
                        <i class="fa fa-caret-left"></i>
                        BACK
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="item_number" class="mb-0">ITEM NUMBER</label>
                        <input type="text" class="form-control form-control-sm{{$errors->has('item_number') ? ' is-invalid' : ''}}" placeholder="Item number" wire:model="item_number">
                        <small class="text-danger">{{ $errors->first('item_number') }}</small>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="item_name" class="mb-0">ITEM NAME</label>
                        <input type="text" class="form-control form-control-sm{{$errors->has('item_name') ? ' is-invalid' : ''}}" placeholder="Item name" wire:model="item_name">
                        <small class="text-danger">{{ $errors->first('item_name') }}</small>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="brand" class="mb-0">BRAND</label>
                        <input type="text" class="form-control form-control-sm{{$errors->has('brand') ? ' is-invalid' : ''}}" placeholder="Brand" wire:model="brand">
                        <small class="text-danger">{{ $errors->first('brand') }}</small>
                    </div>
                </div>
            </div>

            <label class="mb-0">SPECIFICATIONS</label>
            <hr class="my-0">

            <div class="row">
                <div class="col-lg-12 table-responsive p-1 bg-gray rounded">
                    <table class="table table-sm table-bordered bg-white mb-0">
                        <thead>
                            <tr class="text-center bg-gray">
                                <th>SPECIFICATION</th>
                                <th>VALUE</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($specifications as $key => $specification)
                                <tr>
                                    <td class="p-0">
                                        <input type="text" class="form-control form-control-sm border-0" wire:model="specifications.{{$key}}.specification">
                                    </td>
                                    <td class="p-0">
                                        <input type="text" class="form-control form-control-sm border-0" wire:model="specifications.{{$key}}.value">
                                    </td>
                                    <td class="p-0 text-center align-middle">
                                        <button class="btn btn-xs btn-danger py-0" wire:click.prevent="RemoveLine('specifications', {{$key}})">
                                            <i class="fa fa-trash-alt fa-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="p-0 text-right">
                                    <button class="btn btn-xs btn-info mt-1" wire:click.prevent="AddLine">
                                        <i class="fa fa-plus fa-sm"></i>
                                        NEW LINE
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="mb-0">PICTURES</label>
                        <input type="file" class="form-control form-control-sm{{$errors->has('pictures') ? ' is-invalid' : ''}}" wire:model="pictures" multiple accept="image/*">
                        <small class="text-sm">{{$errors->first('pictures')}}</small>
                    </div>
                </div>
                <div class="col-lg-12 table-responsive p-1 bg-gray rounded">
                <table class="table table-sm table-bordered bg-white mb-0">
                        <thead>
                            <tr class="text-center bg-gray">
                                <th>TITLE</th>
                                <th>FILE</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($pictures_arr))
                                @foreach($pictures_arr as $key => $picture)
                                    <tr>
                                        <td class="p-0 align-middle">
                                            <input type="text" class="form-control form-control-sm border-0" wire:model="pictures_arr.{{$key}}.title">
                                        </td>
                                        <td class="p-0 align-middle text-center">
                                            @if($picture['picture'])
                                                <img src="{{$picture['picture']->temporaryUrl()}}" style="max-height: 50px">
                                            @endif
                                        </td>
                                        <td class="p-0 text-center align-middle">
                                            <button class="btn btn-xs btn-danger py-0" wire:click.prevent="RemoveLine('pictures', {{$key}})">
                                                <i class="fa fa-trash-alt fa-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif($type == 'update' && !empty($item->pictures))
                                @foreach($item->pictures as $picture)
                                    <tr>
                                        <td class="p-0 align-middle">
                                            {{$picture->title}}
                                        </td>
                                        <td class="p-0 align-middle text-center">
                                            <img src="{{asset($picture->path).'/small.jpg'}}" style="max-height: 50px">
                                        </td>
                                        <td class="p-0 text-center align-middle">
                                            <button class="btn btn-xs btn-danger py-0" wire:click.prevent="RemoveLine('pictures', {{$picture->id}})">
                                                <i class="fa fa-trash-alt fa-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary btn-sm" wire:click.prevent="SaveItem" wire:loading.attr="disabled" wire:target="SaveItem">
                <i class="fa fa-save"></i>
                SAVE ITEM
            </button>
        </div>
    </div>
</div>
