@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Payments Application</h2>
        </div>

        <div class="card-body">
            <a href="{{ url('payments/create') }}" class="btn btn-success btn-sm "><i class="fa fa-plus" aria-hidden="true">Add
                    New</i></a>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Enrollment No</th>
                            <th>Paid Date</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->enrollment->enroll_no }}</td>
                                <td>{{ $item->paid_date }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>
                                    <a href="{{ url('/payments/' . $item->id) }}" title="view payments"><button
                                            class="btn btn-info btn-sm "><i class="fa fa-eye"
                                                aria-hidden="true">View</i></button></a>
                                    <a href="{{ url('/payments/' . $item->id . '/edit') }}" title="Edit payments"><button
                                            class="btn btn-primary btn-sm "><i class="fa fa-pencil-square-o"
                                                aria-hidden="true">Edit</i></button></a>
                                    <form method="POST" action="{{ url('/payments' . '/' . $item->id) }}"
                                        accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete payments"
                                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                                aria-hidden="true"></i> Delete</button>
                                    </form>
                                    <a href="{{ url('report/report1/' . $item->id) }}" class="btn btn-success"
                                        title="Print Payment">
                                        <i class="fa fa-print" aria-hidden="true"></i> Print
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
