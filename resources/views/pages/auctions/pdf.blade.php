<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUCTION PDF</title>
    <style>
        /* table */
        .table {
            width: 100%;
            margin-bottom: 0.3rem;
            border-collapse: collapse;
        }
        .table thead {
            display: table-header-group;
            vertical-align: top;
        }
        .table tbody {
            display: table-row-group;
            vertical-align: middle;
        }
        .table tr {
            display: table-row;
        }
        .table th, td {
            border: 1.5px solid rgb(16, 16, 16);
            padding: 4px;
            font-size: 11px;
            text-align: left;
            word-wrap: break-word;
            white-space: normal;
        }
        .table-sm td, th {
            padding: 0.3rem;
        }

        .logo {
            max-height: 50px;
        }

        .text-center {
            text-align: center !important;
        }
        .align-middle {
            vertical-align: middle;
        }

        .bg-gray {
            background-color:rgb(70, 73, 73);
            color: white;
        }
        .item-picture {
            margin-top: 30px;
            margin-right: 10px;
            max-height: 100px;
        }
        .p-0 {
            padding: 0;
        }
    </style>
</head>
<body>

    <table class="table table-sm">
        <thead>
            <tr>
                {{-- logo --}}
                <th class="align-middle">
                    <img src="{{public_path('assets/images/BEVI.jpg')}}" alt="logo" class="logo">
                </th>
            </tr>
        </thead>
    </table>

    <table class="table table-sm">
        <thead>
            <tr>
                <th colspan="4" class="bg-gray">AUCTION DETAILS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>AUCTION NO</th>
                <td>{{$auction->auction_code}}</td>
                <th>MINIMUM BID</th>
                <td>{{number_format($auction->min_bid, 2)}}</td>
            </tr>
            <tr>
                <th>START</th>
                <td>{{date('Y-m-d H:i:s a', strtotime($auction->start.' '.$auction->start_time))}}</td>
                <th>END</th>
                <td>{{date('Y-m-d H:i:s a', strtotime($auction->end.' '.$auction->end_time))}}</td>
            </tr>
        </tbody>
    </table>

    @php
    $item = $auction->item;
    @endphp
    <table class="table table-sm">
        <thead>
            <tr>
                <th colspan="4" class="bg-gray">ITEM DETAILS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>ITEM NO</th>
                <td>{{$item->item_number}}</td>
                <th>BRAND</th>
                <td>{{$item->brand}}</td>
            </tr>
            <tr>
                <th>NAME</th>
                <td colspan="3">{{$item->name}}</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-sm">
        <thead>
            <tr>
                <th colspan="2" class="bg-gray">SPECIFICATIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($item->specifications as $specification)
                <tr>
                    <th>{{$specification->specification}}</th>
                    <td>{{$specification->value}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table class="table table-sm">
        <thead>
            <tr>
                <th class="bg-gray">PICTURES</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="p-0">
                    @foreach($item->pictures as $picture)
                        <img src="{{public_path($picture->path).'/small.jpg'}}" alt="{{$picture->title}}" class="item-picture">
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table sm">
        <thead>
            <tr>
                <th colspan="4" class="bg-gray">BIDDERS</th>
            </tr>
            <tr>
                <th>#</th>
                <th>NAME</th>
                <th>BID AMOUNT</th>
                <th>TIMESTAMP</th>
            </tr>
        </thead>
        <tbody>
            @php
                $bidders = $auction->biddings()
                    ->orderBy('bid_amount', 'DESC')
                    ->orderBy('created_at', 'ASC')
                    ->get()
            @endphp
            @foreach($bidders as $bidder)
                <tr>
                    <td>{{}}</td>
                    <td>{{$bidder->user->name}}</td>
                    <td>{{number_format($bidder->bid_amount, 2)}}</td>
                    <td>{{date('Y-m-d H:i:s a', strtotime($bidder->created_at))}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>