<x-app-layout>
    <div class="content-wrapper align-items-center">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
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
                    <form method="POST" action="{{route('user-add-payment')}}">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">ZBC License Payment</h4>
                            <p class="card-description">It's easy just specify ecocash/onemoney number.</p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white">Email</span>
                                </div>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                @foreach (get_license_prices() as $item)
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="price_id" id="optionsRadios{{$item->id}}" value="{{$item->id}}" required>
                                            {{$item->name}} - ${{$item->amount}} lasts for {{$item->period}} days.
                                            <i class="input-helper"></i>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text badge badge-warning" style="color: black;">Onemoney</span>
                                    </div>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text badge badge-primary" style="color: black;">Ecocash</span>
                                    </div>
                                    <input type="tel" name="phone" class="form-control" aria-label="Ecocash or Onemoney number" placeholder="e.g. 0783540959" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-success btn-block btn-fw">
                                <i class="icon-credit-card"></i>
                                Start Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
