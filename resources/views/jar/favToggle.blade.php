
<span class="jar-number">{{ $jar_number }}</span>
<span id="favStar{{ $jar_id }}" class="favorite" onclick="toggleFavorite({{ $jar_id }}, {{ $favorite }})">
	<?php echo $favorite == 1 ? "&#9733;" : "&#9734;" ?>		
</span>
