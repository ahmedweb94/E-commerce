@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (Session()->has('added'))
	<div class="alert alert-success">
		<h3>{{ Session('added') }}</h3>
	</div>
@endif
@if (Session()->has('error'))
	<div class="alert alert-danger">
		<h3>{{ Session('error') }}</h3>
	</div>
@endif
