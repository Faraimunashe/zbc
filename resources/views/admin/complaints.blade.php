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
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My Complaints</h4>
                        @foreach ($complaints as $item)
                            <blockquote class="blockquote blockquote-primary">
                                <p>{{ $item->message }}</p>
                                <footer class="blockquote-footer">
                                    {{ get_user($item->user_id)->name }} <code title="Source Title">{{ $item->created_at }}</code>
                                </footer>
                            </blockquote>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        {{ $complaints->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
