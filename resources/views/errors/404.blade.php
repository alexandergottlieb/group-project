@extends('master')

@section('title')
Something Went Wrong
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>404 :/</h1>
			<h2>That Page Could not be Found</h2>
			<p>{{ $exception->getMessage() }}</p>
		</div>
	</div>
</div>
@stop