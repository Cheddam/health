@extends('back.base')

@section('content')
	
	<div class="pure-g">
		<div class="tools pure-u">
			<h2 class="section-title">Goals</h2>
			<div class="section-options">
				<a href="/back/goals/create" class="pure-button pull-right">Add new Goal</a>
				<a href="/back/categories/create" class="pure-button pull-right">Add new Category</a>
			</div>
		</div>
	</div>
	<div class="pure-g">
		<div class="pure-u">
			<ul class="category-list pure-u">
				@foreach($categories as $category)
				<li class="category">
					<h4>{{ $category->name }} <a href="/back/categories/{{ $category->id }}/edit">(edit)</a></h4>
					<ul class="goal-list">
						@foreach($category->goals as $goal)
						<li class="goal">[{{ $goal->points }}] {{ $goal->name }} <a href="/back/goals/{{ $goal->id }}/edit">(edit)</a></li>
						@endforeach
					</ul>
				</li>
				@endforeach
			</ul>
		</div>
	</div>

@endsection

@section('css')
	<link rel="stylesheet" href="/css/components/goals.css">
@endsection

@section('js')
@endsection