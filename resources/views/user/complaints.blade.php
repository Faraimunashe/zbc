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
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My Complaints</h4>
                        @foreach ($complaints as $item)
                            <blockquote class="blockquote blockquote-primary">
                                <p>{{ $item->message }}</p>
                                <footer class="blockquote-footer">
                                    <code title="Source Title">{{ $item->created_at }}</code>
                                </footer>
                            </blockquote>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Complaint Form</h4>
                        <p class="card-description">Let ZBC know about your issues</p>
                        <form class="forms-sample" method="POST" action="{{ route('user-add-complaint') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleTextarea1">Text Message</label>
                                <textarea name="message" class="form-control" id="exampleTextarea1" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">
                                Complain
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
