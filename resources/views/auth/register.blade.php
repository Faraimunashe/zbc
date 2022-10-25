<x-guest-layout>
    <h6 class="font-weight-light">Register to create account.</h6>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form class="pt-2" action="{{route('register')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="fname" class="form-control form-control-lg" placeholder="Firstname" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="lname" class="form-control form-control-lg" placeholder="Lastname" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Username" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email address" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="phone" class="form-control form-control-lg" placeholder="Phone" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="city" class="form-control form-control-lg" placeholder="City" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="text" name="address" class="form-control form-control-lg" placeholder="Address" required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Confirm password" required>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">
                Create Account
            </button>
        </div>
        <div class="text-center mt-4 font-weight-light">
            Already have an account? <a href="{{route('login')}}" class="text-primary">Login</a>
        </div>
    </form>
</x-guest-layout>
