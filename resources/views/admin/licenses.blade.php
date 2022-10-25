<x-app-layout>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center mb-4">
                            <h4 class="card-title mb-sm-0">License Prices</h4>
                            <button type="button" class="btn btn-success ml-auto mb-3 mb-sm-0" data-toggle="modal" data-target="#exampleModal">
                                Add New
                            </button>
                        </div>
                        <div class="table-responsive border rounded p-1">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold">#</th>
                                        <th class="font-weight-bold">Package</th>
                                        <th class="font-weight-bold">Amount</th>
                                        <th class="font-weight-bold">Period</th>
                                        <th class="font-weight-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($prices as $item)
                                        <tr>
                                            <td>
                                                @php
                                                    $count++;
                                                    echo $count;
                                                @endphp
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>${{$item->amount}}</td>
                                            <td>{{$item->period}}</td>
                                            <td>
                                                <button type="button" class="btn btn-inverse-primary btn-icon" data-toggle="modal" data-target="#editPriceModal{{$item->id}}">
                                                    <i class="icon-note"></i>
                                                    <div></div>
                                                </button>
                                                <button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#deletePriceModal{{$item->id}}">
                                                    <i class="icon-trash"></i>
                                                    <div></div>
                                                </button>
                                            </td>
                                        </tr>
                                        <!--Edit Modal -->
                                        <div class="modal fade" id="editPriceModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{route('edit-license-price')}}">
                                                        @csrf
                                                        <input type="hidden" name="price_id" value="{{$item->id}}" required>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Prices</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="name">Package Name</label>
                                                                <input type="text" name="name" id="name" class="form-control" value="{{$item->name}}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="amount">Amount</label>
                                                                <input type="text" name="amount" class="form-control" id="amount" value="{{$item->amount}}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="period">Period (days)</label>
                                                                <input type="number" name="period" id="period" class="form-control" value="{{$item->period}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="deletePriceModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{route('delete-license-price')}}">
                                                        @csrf
                                                        <input type="hidden" name="price_id" value="{{$item->id}}" required>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Package</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete <b>{{ $item->name }}</b> package?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Yes delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">License Penalty Price</h4>
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center">
                                <div class="d-flex flex-row align-items-center">

                                    <p class="mb-0 ml-1">
                                        <strong>{{ get_penalty()->percentage_rate }}% / {{ get_penalty()->period }} days</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-center mt-3">
                                <button type="button" class="btn btn-outline-warning btn-icon-text" data-toggle="modal" data-target="#updatePenaltyModal">
                                    <i class="icon-refresh btn-icon-prepend"></i>
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{route('add-license-price')}}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Package</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Package Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="License package name" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" name="amount" class="form-control" id="amount" placeholder="License price" required>
                        </div>
                        <div class="form-group">
                            <label for="period">Period (days)</label>
                            <input type="number" name="period" id="period" class="form-control" placeholder="License period length" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Penalty Modal -->
    <div class="modal fade" id="updatePenaltyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{route('update-penalty')}}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Penalty Rate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="percentage_rate">Percentage</label>
                            <input type="text" name="percentage_rate" class="form-control" id="percentage_rate" placeholder="% of license price" required>
                        </div>
                        <div class="form-group">
                            <label for="period">Period (days)</label>
                            <input type="number" name="period" id="period" class="form-control" placeholder="number of days" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
