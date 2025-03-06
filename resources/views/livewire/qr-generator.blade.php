<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">QR GENERATOR</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <label for="" class="mb-0">LINK</label>
                    <input type="text" class="form-control form-control-sm{{$errors->has('link') ? ' is-invalid' : ''}}" wire:model="link">
                    <small class="text-danger">{{$errors->first('link')}}</small>
                </div>
                
                <div class="col-lg-4">
                    <label for="">SIZE</label>
                    <input type="number" class="form-control form-control-sm{{$errors->has('size') ? ' is-invalid' : ''}}" wire:model="size">
                    <small class="text-danger">{{$errors->first('size')}}</small>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary" wire:click.prevent="GenerateQR">
                GENERATE QR
            </button>
        </div>
    </div>

    @if(!empty($qr_link))
    <div class="card">
        <div class="card-body text-center">
            {!! DNS2D::getBarcodeSVG($qr_link, 'QRCODE', $this->size, $this->size) !!}
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-success" wire:click.prevent="DownloadSVG">
                <i class="fa fa-download"></i>
                DOWNLOAD SVG
            </button>
        </div>
    </div>
    @endif
</div>
