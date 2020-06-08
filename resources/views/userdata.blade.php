@extends ('layout')

@section ('content')



<div class="card mb-4">
    <div class="card-body">
		<h4 style="text-decoration: underline; font-family: Open Sans">User Data</h4>
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Pincode</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach ($records as $record)
		  	<tr>
		      <th scope="row">{{ $loop->index + 1 }}</th>
		      <td>{{ $record->name }}</td>
		      <td>{{ $record->email }}</td>
		      <td>{{ $record->pincode }}</td>
		    </tr>
			@endforeach

		  </tbody>
		</table>
	</div>
</div>

@endsection