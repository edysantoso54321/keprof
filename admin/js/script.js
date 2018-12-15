function exec() {
	$('#result').remove();
	$('#error').remove();
	var query = '';
	query = $('#theQuery').val();
	if (query == '') {
		var msg = '<div id="error"><p>Query tidak boleh kosong</p></div>';
		$('#example').append(msg);
	} else if (query != null) {
		var request = $.ajax({
			url: "thePhp.php",
			type: "POST",
			data: {
				data: query
			},
			dataType: "html"
		});
		request.done(function (msg) {
			$('#example').append(msg);
		});
		request.fail(function (jqXHR, textStatus) {
			alert("Request failed: " + textStatus);
		});
	}
}
$(function () {
	exec();
	$('nav ul li a:not(:only-child)').click(function (e) {
		$(this).siblings('.nav-dropdown').toggle();
		$('.nav-dropdown').not($(this).siblings()).hide();
		e.stopPropagation();
	});
	$('#nav-toggle').click(function () {
		$('aside').slideToggle();
	});
	$('#nav-toggle').on('click', function () {
		this.classList.toggle('active');
	});
	$('#exec').click(function () {
		exec();
	});
});

// Get the modal
var modal = document.getElementById('myModal');
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function () {
	modal.style.display = "block";
}

span.onclick = function () {
	modal.style.display = "none";
}

window.onclick = function (event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}