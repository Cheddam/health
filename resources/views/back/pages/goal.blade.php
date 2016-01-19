@extends('back.base')

@section('content')

	@if (isset($goal))
		<h2>Update Goal</h2>
	@else
		<h2>Create Goal</h2>
	@endif

	<form action="{{ isset($goal) ? '/back/goals/' . $goal->id : '/back/goals' }}" method="post">
		{{ csrf_field() }}
		@if (isset($goal))
			{{ method_field('PUT') }}
		@endif
		
		<p>
			<label for="name">Name</label>
			<input type="text" name="name" value="{{ isset($goal) ? $goal->name : '' }}">
		</p>
		
		<p>
			<label for="points">Points</label>
			<input type="text" name="points" value="{{ isset($goal) ? $goal->points : '' }}">
		</p>

		<p>
			<label for="category">Category</label>
			<select name="category">
				@forelse($categories as $category)
					<option value="{{ $category->id }}" {{ (isset($goal) && $goal->category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
				@empty
					<option value="0">Please create a category first!</option>
				@endforelse
			</select>
		</p>
			
		<p>
			<label for="weight">Weight</label>
			<input type="number" name="weight" value="{{ isset($goal) ? $goal->weight : '' }}">
		</p>

		<p>
			@if (isset($goal))
				<button type="submit">Update Goal</button>
			@else
				<button type="submit">Create Goal</button>
			@endif
		</p>

	</form>

@endsection