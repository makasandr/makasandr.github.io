<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
	<div class="row top-mg-2">
		<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-0 bottom-mg-4">
			<div class="students-control">
				<p class="gray-line size-small up-case bottom-mg-1">Students statistic</p>
				<div class="date-pick">
					<div class="col-xs-6 col-sm-4 bottom-mg-1">
						<p class="inline up-case size-small bold gray">From: </p>
						<input type="text" class="datepicker from-date center size-small left-mg-half">
					</div>
					<div class="col-xs-6 col-sm-4 bottom-mg-1">
						<p class="inline up-case size-small bold gray">To: </p>
						<input type="text" class="datepicker to-date center size-small left-mg-half">
					</div>
					<div class="col-xs-12 col-sm-4 bottom-mg-2">
						<div class="select-style">
							<select class="order small-line col-xs-12 pd-0">
								<option value="1">Amount of purchases</option>
								<option value="2">Registration date</option>
								<option value="3">Level</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12"></div>
				</div>
			</div>
			<div id="students" class="nano bottom-mg-2">
				<div class="nano-content">
					<!-- data from students.php -->
				</div>
			</div>
			<a href="/admin/student" class="button col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 size-small white up-case center">Add new student</a>
		</div>

		<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-0 bottom-mg-4">
			<div class="trainers-control">
				<p class="gray-line size-small up-case bottom-mg-1">Trainers statistic</p>
				<div class="date-pick">
					<div class="col-xs-6 col-sm-4 bottom-mg-1">
						<p class="inline up-case size-small bold gray">From: </p>
						<input type="text" class="datepicker from-date center size-small left-mg-half">
					</div>
					<div class="col-xs-6 col-sm-4 bottom-mg-1">
						<p class="inline up-case size-small bold gray">To: </p>
						<input type="text" class="datepicker to-date center size-small left-mg-half">
					</div>
					<div class="col-xs-12 col-sm-4 bottom-mg-2">
						<div class="select-style">
							<select class="order small-line col-xs-12 pd-0">
								<option value="1">Amount of sales</option>
								<option value="2">Registration date</option>
								<option value="3">Rating</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12"></div>
				</div>
			</div>
			<div id="trainers" class="nano bottom-mg-2">
				<div class="nano-content">
					<!-- data from trainers.php -->
				</div>
			</div>

			<a href="/admin/trainer" class="button col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 size-small white up-case center">Add new trainer</a>
		</div>
	</div>
</div>

<script>
	function load_students(from, to, order) {
		$.ajax({
			type: 'POST',
			url: '/admin/students',
			data: 'from='+from+'&to='+to+'&order='+order,
			dataType: 'html',
			success: function(data) {
				$("#students .nano-content").html(data);
			}
		});
	};
	function students_refresh() {
		var students_from = moment($('.students-control .from-date').val(), "DD.MM.YYYY").unix();
		var students_to = moment($('.students-control .to-date').val(), "DD.MM.YYYY").unix();
		var students_order = $('.students-control .order').val();
		if (students_order == 3) {
			students_from = 0;
			students_to = moment().unix();
		}
		load_students(students_from, students_to, students_order);
	}

	function load_trainers(from, to, order) {
		$.ajax({
			type: 'POST',
			url: '/admin/trainers',
			data: 'from='+from+'&to='+to+'&order='+order,
			dataType: 'html',
			success: function(data) {
				$("#trainers .nano-content").html(data);
			}
		});
	};
	function trainers_refresh() {
		var trainers_from = moment($('.trainers-control .from-date').val(), "DD.MM.YYYY").unix();
		var trainers_to = moment($('.trainers-control .to-date').val(), "DD.MM.YYYY").unix();
		var trainers_order = $('.trainers-control .order').val();
		if (trainers_order == 3) {
			trainers_from = 0;
			trainers_to = moment().unix();
		}
		load_trainers(trainers_from, trainers_to, trainers_order);
	}

	$(function() {
		$(".nano").nanoScroller();

		$(".datepicker").datepicker();
	    $(".datepicker").datepicker( "option", "dateFormat", "dd.mm.yy");
	    var currentDate = new Date();  
		$(".datepicker").datepicker("setDate",currentDate);

		var to = new Date().getTime() / 1000;
		var from = to - 2629746;
		var from_f = moment.unix(from);
		from_f = from_f.format("DD.MM.YYYY");
		load_students(from, to, 1);
		load_trainers(from, to, 1);
		$('.datepicker.from-date').datepicker("setDate", from_f);
	});

	$('.students-control .from-date').datepicker({
	    onSelect: function(dateText, inst) {
	    	students_refresh();
	    }
	});
	$('.students-control .to-date').datepicker({
	    onSelect: function(dateText, inst) {
	    	students_refresh();
	    }
	});
	$('.students-control .order').change(function(event) {
		students_refresh();
	});

	$('.trainers-control .from-date').datepicker({
	    onSelect: function(dateText, inst) {
	    	trainers_refresh();
	    }
	});
	$('.trainers-control .to-date').datepicker({
	    onSelect: function(dateText, inst) {
	    	trainers_refresh();
	    }
	});
	$('.trainers-control .order').change(function(event) {
		trainers_refresh();
	});
</script>

<?php include ROOT . '/views/layouts/footer.php'; ?>