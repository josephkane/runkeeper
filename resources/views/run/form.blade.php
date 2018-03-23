@extends('layouts.app')

@section('content')
<div>
	<h4>{{ $modify == 1 ? "Edit Run" : "New Run" }}</h4>
	<form action="{{ $modify == 1 ? route('update_run', ['run_id' => $run_id]) : route('create_run') }}" method="post">
		{{ csrf_field() }}
		<div>
			<div>
				<label>Name</label>
				<input type="text" name="name" value="{{ old('name') ? old('name') : $name }}">
				<small>{{ $errors->first("name") }}</small>
			</div>
			<div>
				<label>Description</label>
				<input type="text" name="description" value="{{ old('description') ? old('description') : $description }}">
			</div>
			<div>
				<label>Grain Bill</label>
				<input type="text" name="grain_bill" value="{{ old('grain_bill') ? old('grain_bill') : $grain_bill }}">
			</div>
			<div>
				<label>Volume</label>
				<input type="text" name="volume" value="{{ old('volume') ? old('volume') : $volume }}">
				<small>{{ $errors->first("volume") }}</small>
			</div>
			<div>
				<label>ABV</label>
				<input type="text" name="abv" value="{{ old('abv') ? old('abv') : $abv }}">
				<small>{{ $errors->first("abv") }}</small>
			</div>
			<div>
				<label>Notes</label>
				<input type="text" name="notes" value="{{ old('notes') ? old('notes') : $notes }}">
			</div>
			<div>
				<input type="submit" value="Save">
			</div>
			<a href="{{ route('runs') }}">Cancel</a>
		</div>
	</form>
</div>
@endsection