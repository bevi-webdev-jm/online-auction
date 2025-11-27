<div>
    <div class="card">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-lg-6 align-middle">
                    <strong class="text-lg">ITEM UPLOAD</strong>
                </div>
                <div class="col-lg-6 text-right">
                    <a href="{{route('item.index')}}" class="btn btn-secondary btn-xs">
                        <i class="fa fa-caret-left"></i>
                        BACK
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body py-1">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">UPLOAD FILE</label>
                        <input type="file" class="form-control form-control-sm" wire:model.live="upload_file">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>

    @if(!empty($preview))
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">PREVIEW</h3>
                <div class="card-tools">
                    <button class="btn btn-success btn-sm" wire:click.prevent="uploadItem">
                        <i class="fa fa-save mr-1"></i>
                        UPLOAD ITEMS
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm table-hover">
                    <thead>
                        <tr class="text-center">
                            <th class="align-middle p-0">Item #</th>
                            <th class="align-middle p-0">Name</th>
                            <th class="align-middle p-0">Brand</th>
                            @foreach (array_keys($preview[0]['specifications']) as $specKey)
                                <th class="align-middle p-0">{{ $specKey }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preview as $item)
                            <tr class="text-center">
                                <td class="align-middle py-0">{{ $item['item_number'] }}</td>
                                <td class="align-middle py-0">{{ $item['item_name'] }}</td>
                                <td class="align-middle py-0">{{ $item['brand'] }}</td>
                                @foreach ($item['specifications'] as $specValue)
                                    <td class="align-middle py-0">{{ $specValue }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endif
</div>
