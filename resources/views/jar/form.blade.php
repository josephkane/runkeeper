@extends('layouts.app')

@section('content')
<div>
	<h4>{{ $modify == 1 ? "Edit Jar" : "New Jar" }}</h4>
	<form action="{{ $modify == 1 ? route('update_jar', ['jar_id' => $jar_id]) : route('create_jar', ['run_id' => $run_id]) }}" method="post">
		{{ csrf_field() }}
		<div>
			<div>
				<label>Starting proof</label>
				<input type="text" name="proof_start" value="{{ old('proof_start') ? old('proof_start') : $proof_start }}">
				<small>{{ $errors->first("proof_start") }}</small>
			</div>
			<div>
				<label>Starting column temperature</label>
				<input type="text" name="column_temp_start" value="{{ old('column_temp_start') ? old('column_temp_start') : $column_temp_start }}">
				<small>{{ $errors->first("column_temp_start") }}</small>
			</div>
			<div>
				<label>Ending proof</label>
				<input type="text" name="proof_end" value="{{ old('proof_end') ? old('proof_end') : $proof_end }}">
			</div>
			<div>
				<label>Ending column temperature</label>
				<input type="text" name="column_temp_end" value="{{ old('column_temp_end') ? old('column_temp_end') : $column_temp_end }}">
			</div>
			<div>
				<label>Volume</label>
				<input type="text" name="volume" value="{{ old('volume') ? old('volume') : $volume }}">
			</div>
			<div>
				<input type="submit" value="Save">
			</div>
			<a href="{{ route('jars', ['run_id' => $run_id]) }}">Cancel</a>
		</div>
	</form>
</div>
@endsection