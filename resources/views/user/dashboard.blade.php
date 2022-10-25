<x-app-layout>
    @php
        $license = get_latest_license($account->id);
    @endphp
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary">
                    <span class="card-body d-lg-flex align-items-center">
                        <p class="mb-lg-0">Did you know you can extend your television license period by buying a package before the current package expires?</p>
                        <a href="{{route('user-payment')}}" class="btn btn-warning purchase-button btn-sm my-1 my-sm-0 ml-auto">
                            Extend License
                        </a>
                        <button class="close popup-dismiss ml-2">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-sm-flex align-items-baseline report-summary-header">
                                <h5 class="font-weight-semibold">ZBC radio & television license</h5> <span class="ml-auto">refresh</span> <button class="btn btn-icons border-0 p-2"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                        @if (is_null($license))
                            <div class="row report-inner-cards-wrapper">
                                <div class="col-md-6 col-xl report-inner-card">
                                    <div class="inner-card-text">
                                        <span class="report-title">Status</span>
                                        <h4>No License</h4>
                                        <span class="report-count"><a href="{{route('user-payment')}}">buy license</a></span>
                                    </div>
                                    <div class="inner-card-icon bg-warning">
                                        <i class="icon-dislike"></i>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl report-inner-card">
                                    <address class="text-primary">
                                    <p class="font-weight-bold">Account Name: </p>
                                    <p class="mb-2"> {{$account->lname}} {{$account->fname}} </p>
                                    <p class="font-weight-bold">Physical Address: </p>
                                    <p>{{$account->address}} {{$account->city}} </p>
                                    </address>
                                </div>
                                <div class="col-md-6 col-xl report-inner-card">
                                    <address>
                                        <p class="font-weight-bold">Date Issued:</p>
                                        <p>-</p>
                                        <p class="font-weight-bold">Reference:</p>
                                        <p>-</p>
                                    </address>
                                </div>
                                <div class="col-md-6 col-xl report-inner-card">
                                    <address>
                                        <p class="font-weight-bold">Amount Paid:</p>
                                        <p>$ -</p>
                                        <p class="font-weight-bold">Expiry:</p>
                                        <p> - </p>
                                    </address>
                                </div>
                            </div>
                        @else
                            <div class="row report-inner-cards-wrapper">
                                <div class="col-md-6 col-xl report-inner-card">
                                    <div class="inner-card-text">
                                        <span class="report-title">Status</span>
                                        <h4>{{license_status($license->status)->label}}</h4>
                                    </div>
                                    <div class="inner-card-icon bg-{{license_status($license->status)->badge}}">
                                        <i class="icon-emotsmile"></i>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl report-inner-card">
                                    <address class="text-primary">
                                    <p class="font-weight-bold">Account Name: </p>
                                    <p class="mb-2"> {{$account->lname}} {{$account->fname}} </p>
                                    <p class="font-weight-bold">Physical Address: </p>
                                    <p>{{$account->address}} {{$account->city}} </p>
                                    </address>
                                </div>
                                <div class="col-md-6 col-xl report-inner-card">
                                    <address>
                                        <p class="font-weight-bold">Date Issued:</p>
                                        <p>{{$license->created_at}}</p>
                                        <p class="font-weight-bold">Reference:</p>
                                        <p>{{$license->reference}}</p>
                                    </address>
                                </div>
                                <div class="col-md-6 col-xl report-inner-card">
                                    <address>
                                        <p class="font-weight-bold">Amount Paid:</p>
                                        <p>$ {{$license->amount + $license->penalt_amount}}</p>
                                        <p class="font-weight-bold">Expiry:</p>
                                        <p> {{$license->valid_until}} </p>
                                    </address>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
