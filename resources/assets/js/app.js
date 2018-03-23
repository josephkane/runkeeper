require('./bootstrap');


window.toggleFavorite = function (jar_id, fav) {
	
	const toggle = {"0": "&#9733;", "1": "&#9734;"}
	
	$.ajax({
		type: "POST",
		url: `/jar/${jar_id}/toggle_favorite`,
		data: {
			"favorite": fav,
			"jar_id": jar_id,
			'_token': $('meta[name="csrf-token"]').attr('content')
		}
	}).done(function(res) {
		$(`#jar${jar_id}`).html(res)
	}).fail(function(res) {
		alert("Something went wrong on our end, please refresh the page and try again.")
	})
}

window.deleteRun = function (run_id) {

	$.ajax({
		type: "DELETE",
		url: `/run/${run_id}/delete`,
		data: {
			"run_id": run_id,
			'_token': $('meta[name="csrf-token"]').attr('content')
		}
	}).done(function(res) {
		$(`#run${run_id}`).remove();
	}).fail(function(res) {
		alert("Something went wrong on our end, please refresh the page and try again.")
	})
}

