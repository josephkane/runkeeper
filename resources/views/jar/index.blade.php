@extends('layouts.app')

@section('content')

<div class="jar-index-wrapper">
	
	@foreach ($jars as $jar)
	<div class="jar-card">
		<div id="jar{{ $jar->id }}" class="jar-header">
			<span class="jar-number">{{ $jar->number }}</span>
			<span id="favStar{{ $jar->id }}" class="favorite" onclick="toggleFavorite({{ $jar->id }}, {{ $jar->favorite }})">
				<?php echo $jar->favorite == 1 ? "&#9733;" : "&#9734;" ?>
			</span>
		</div>
		<div class="jar-body">
			<span class="attr-label">Time started:
				<time class="attr">{{ $jar->time_started }}</time>
			</span>
			<span class="attr-label">Starting proof:
				<span class="attr">{{ $jar->proof_start }}</span>
			</span>
			<span class="attr-label">Starting column temp:
				<span class="attr">{{ $jar->column_temp_start }}</span>
			</span>
			<span class="attr-label">Ending proof:
				<span class="attr">{{ $jar->proof_end }}</span>
			</span>
			<span class="attr-label">Ending column temp:
				<span class="attr">{{ $jar->column_temp_end }}</span>
			</span>
			<span class="attr-label">Volume:
				<span class="attr">{{ $jar->volume }}</span>
			</span>
		</div>
		<div>
			<a href="{{ route('jar_details', ['jar_id' => $jar->id]) }}" class="btn btn-primary edit-jar">Edit</a>
		</div>
	</div>
	@endforeach
</div>
<div class="jar-index-buttons">
	<a href="{{ route('new_jar', ['run_id' => $run_id]) }}" class="btn btn-primary">Add new jar</a>
	<a href="{{ route('runs', ['run_id' => $run_id]) }}" class="btn btn-success">Back</a>
</div>
@endsection