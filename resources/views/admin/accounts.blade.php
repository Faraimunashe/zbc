<x-app-layout>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                        <h4 class="card-title mb-sm-0">Accounts</h4>
                        <a href="#" class="text-dark ml-auto mb-3 mb-sm-0"> print accounts</a>
                    </div>
                    <div class="table-responsive border rounded p-1">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold">Account #</th>
                                    <th class="font-weight-bold">Name</th>
                                    <th class="font-weight-bold">Phone</th>
                                    <th class="font-weight-bold">Email</th>
                                    <th class="font-weight-bold">Type</th>
                                    <th class="font-weight-bold">License</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>
                                            {{$account->accnum}}
                                        </td>
                                        <td>{{$account->lname}} {{$account->fname}}</td>
                                        <td>{{$account->phone}}</td>
                                        <td>{{get_user($account->user_id)->email}}</td>
                                        <td>{{$account->type}}</td>
                                        <td>
                                            @if (is_licensed($account->id))
                                                <div class="badge badge-success p-2">Valid</div>
                                            @else
                                                <div class="badge badge-danger p-2">Expired</div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex mt-4 flex-wrap">
                        <p class="text-muted">Showing 1 to 10 of 57 entries</p>
                        <nav class="ml-auto">
                            {{$accounts->links('pagination::bootstrap-4')}}
                        </nav>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
