@extends('back.base')

@section('content')

	@if (isset($category))
		<h2>Update Category</h2>
	@else
		<h2>Create Category</h2>
	@endif

	<form action="{{ isset($category) ? '/back/categories/' . $category->id : '/back/categories' }}" method="post">
		{{ csrf_field() }}
		@if (isset($category))
			{{ method_field('PUT') }}
		@endif
		
		<p>
			<label for="name">Name</label>
			<input type="text" name="name" value="{{ isset($category) ? $category->name : '' }}">
		</p>
			
		<p>
			<label for="weight">Weight</label>
			<input type="number" name="weight" value="{{ isset($category) ? $category->weight : '' }}">
		</p>

		<p>
			@if (isset($category))
				<button type="submit">Update Category</button>
			@else
				<button type="submit">Create Category</button>
			@endif
		</p>

	</form>

@endsection