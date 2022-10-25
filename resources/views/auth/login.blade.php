<x-guest-layout>
    <h6 class="font-weight-light">Sign in to continue.</h6>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="pt-2" action="{{route('login')}}" method="POST">
        @csrf
        <div class="form-group">
            <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email address" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
        </div>
        <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">
                SIGN IN
            </button>
        </div>
        <div class="text-center mt-4 font-weight-light">
            Don't have an account? <a href="{{route('register')}}" class="text-primary">Create</a>
        </div>
    </form>
</x-guest-layout>
