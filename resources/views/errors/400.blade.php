@extends('master')

@section('title')
Something Went Wrong
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>400 :(</h1>
			<h2>Something went wrong.</h2>
			<p>{{ $exception->getMessage() }}</p>
		</div>
	</div>
</div>
@stop