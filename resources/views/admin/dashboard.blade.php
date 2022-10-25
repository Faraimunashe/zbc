<x-app-layout>
    <div class="content-wrapper">
        <!-- Quick Action Toolbar Starts-->
        <div class="row quick-action-toolbar">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header d-block d-md-flex">
                        <h5 class="mb-0">Quick Actions</h5>
                        <p class="ml-auto mb-0">How are your active users trending overtime?<i class="icon-bulb"></i></p>
                    </div>
                    <div class="d-md-flex row m-0 quick-action-btns" role="group" aria-label="Quick action buttons">
                        <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                            <a href="{{route('admin-accounts')}}" class="btn px-0"> <i class="icon-user mr-2"></i> View Accounts</a>
                        </div>
                        <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                            <a href="{{route('admin-licenses')}}" class="btn px-0"><i class="icon-docs mr-2"></i>License Prices</a>
                        </div>
                        <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                            <a href="{{route('admin-transactions')}}" class="btn px-0"><i class="icon-folder mr-2"></i>See Transactions</a>
                        </div>
                        <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                            <button type="button" class="btn px-0"><i class="icon-book-open mr-2"></i>View Invoice</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick Action Toolbar Ends-->
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="d-sm-flex align-items-baseline report-summary-header">
                        <h5 class="font-weight-semibold">Report Summary</h5> <span class="ml-auto">Updated Report</span> <button class="btn btn-icons border-0 p-2"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    </div>
                    <div class="row report-inner-cards-wrapper">
                    <div class=" col-md -6 col-xl report-inner-card">
                        <div class="inner-card-text">
                        <span class="report-title">Revenue</span>
                        <h4>${{get_revenue()}}</h4>
                        <span class="report-count">Download Report</span>
                        </div>
                        <div class="inner-card-icon bg-success">
                        <i class="icon-rocket"></i>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                        <span class="report-title">Accounts</span>
                        <h4>{{count_account()}}</h4>
                        <span class="report-count"> View List</span>
                        </div>
                        <div class="inner-card-icon bg-danger">
                        <i class="icon-user"></i>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                        <span class="report-title">Transactions</span>
                        <h4>{{count_transactions()}}</h4>
                        <span class="report-count">View List</span>
                        </div>
                        <div class="inner-card-icon bg-warning">
                        <i class="icon-briefcase"></i>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                        <span class="report-title">Valid License</span>
                        <h4>{{count_valid_licenses()}}</h4>
                        <span class="report-count">View Report</span>
                        </div>
                        <div class="inner-card-icon bg-primary">
                        <i class="icon-doc"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
