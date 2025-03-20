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
            max-width: 150px;
        }
        .th-logo {
            width: 160px !important;
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
            margin-right: 5px;
            margin-left: 5px;
            max-height: 100px;
        }
        .p-0 {
            padding: 0 !important;
        }
        .m-0 {
            margin: 0 !important;
        }
        .header-title {
            font-size: 30px !important;
            padding-right: 110px !important;
        }
    </style>
</head>
<body>

    <table class="table table-sm">
        <thead>
            <tr>
                <th class="align-middle text-center p-0 m-0 th-logo">
                    <img src="{{public_path('assets/images/BEVI.jpg')}}" alt="logo" class="logo">
                </th>
                <th class="header-title text-center align-middle">
                    ONLINE AUCTION
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

        @php
        $item = $auction->item;
        @endphp
        
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
                <td class="p-0 align-middle">
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
                <th class="text-center">#</th>
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
                    ->get();

            @endphp
            @if(!empty($bidders->count()))
                @foreach($bidders as $key => $bidder)
                    <tr>
                        <td class="text-center">{{$key + 1}}</td>
                        <td>{{$bidder->user->name}}</td>
                        <td>{{number_format($bidder->bid_amount, 2)}}</td>
                        <td>{{date('Y-m-d H:i:s a', strtotime($bidder->created_at))}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center align-middle">
                        -NO BIDDERS-
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

</body>
</html>