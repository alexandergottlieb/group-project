@extends('master')

@section('title')
Welcome
@stop

@section('content')
<header class="row" style="background-image:url('/images/headers/registration.jpg')">
	<div class="col-md-12">
	    <h1>Welcome</h1>
	</div>
    <div class="col-md-5 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
<!--                         <label for="email" class="col-md-4 control-label">E-Mail Address</label> -->

                        <div class="col-md-8 col-md-offset-2">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
<!--                         <label for="password" class="col-md-4 control-label">Password</label> -->

                        <div class="col-md-8 col-md-offset-2">
                            <input id="password" type="password" class="form-control" name="Password" placeholder="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input  type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
	                    <p>
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
	                    </p>
						<p>
                        	<a href="{{ route('password.request') }}">
                        	    Forgot Your Password?
                        	</a>
						</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3">
		<div class="panel panel-default">
            <div class="panel-heading">New Here?</div>
            <div class="panel-body">
            	<a href="<?php echo route('register'); ?>"><button class="btn btn-primary">Register</button></a>
            </div>
        </div>
    </div>
</header>
@endsection
