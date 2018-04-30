@if (Session::has('success'))

	<div class="alert alert-primary" role="alert">
  		<strong>Success:</strong> {{ Session::get('success') }}
	</div>

@endif


@if (count($errors) > 0)

	<div class="alert alert-danger" role="alert">
		<ul>
			<strong>Errors:</strong>
			@foreach ($errors->all() as $error)

				<li>{{ $error }}</li>

			@endforeach
		</ul>
	</div>

@endif