@extends('admin.layouts')
@section('content')
    <div>
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <h3 class="page-title mt-3">Earnings</h3>
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                           <th>id</th>
                           <th>invoice_number</th>
                           <th>listing_id</th>
                           <th>booking_id</th>
                           <th>listing_fee</th>
                           <th>booking_fee</th>
                           <th>total</th>
                           <th>timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        @foreach ($tk as $item)
                            <tr>
                                <td>{{$counter}}</td>
                                <td>{{$item->invoice}}</td>
                                <td>{{$item->listing_id}}</td>
                                <td>{{$item->booking_id}}</td>
                                <td>{{$item->listing_fee}}</td>
                                <td>{{$item->booking_fee}}</td>
                                <td>{{$item->total}}</td>
                                <td>{{$item->updated_at}}</td>
                            </tr>
                            <?php $counter++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection