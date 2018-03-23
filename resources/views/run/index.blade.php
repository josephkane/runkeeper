@extends('layouts.app')

@section('content')
<div class="run-index-wrapper">
	@foreach ($runs as $run)
	<div id="run{{ $run->id }}" class="run-wrapper">
		<div class="run-header">
			<div class="header-content">
				<span class="run-headline">{{ $run->name }}</span>
				<span class="run-description">{{ $run->description }}</span>
			</div>
			<div>
				<a href="{{ route('run_details', ['run_id' => $run->id]) }}" class="btn btn-primary">Edit</a>
				<a href="{{ route('jars', ['run_id' => $run->id]) }}" class="btn btn-success">Jars</a>
				<span class="btn btn-danger" onclick="deleteRun({{ $run->id }})">x</a>
			</div>
		</div>
		<div class="run-body">
			<span class="attr-label">Date:
				<span class="attr">{{ $run->date }}</span>
			</span>
			<span class="attr-label">Grain bill:
				<span class="attr">{{ $run->grain_bill }}</span>
			</span>
			<span class="attr-label">Volume:
				<span class="attr">{{ $run->volume }} gal.</span>
			</span>
			<span class="attr-label">ABV:
				<span class="attr">{{ $run->abv }}</span>
			</span>
			<span class="attr-label">Notes:
				<span class="attr">{{ $run->notes }}</span>
			</span>
		</div>
	</div>
	@endforeach
	<a href="{{ route('new_run') }}" class="btn btn-primary start-new-run">Start a new run</a>
</div>

@endsection