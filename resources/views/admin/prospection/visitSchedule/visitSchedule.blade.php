@extends('layouts.app')

@section('title', 'Home')

@section('content')
@include($header)

<!-- Contact #1 ============================================= -->
<section id="contact" class="contact">
	<div class="container">
		<div class="row">
			<!-- .col-md-12 end -->
			<div class="col-xs-12 col-sm-12 col-md-12 ibox-content">
				<div id="calendar"></div>
			</div>
		</div>
		<!-- .row end -->
	</div>
	<!-- .container end -->
</section>
@include('admin.prospection.leads.schedule', [
'showSearchLeads' => true,
])
@endsection

@section('css')
@parent
<link href="/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
<link href="/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>

<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />

<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
@endsection

@section('scripts')
@parent
<script src="/js/plugins/fullcalendar/moment.min.js"></script>
<!-- Full Calendar -->
<script src="/js/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="/js/plugins/fullcalendar/locale-all.js"></script>
<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}"></script>

<script>
	$(document).ready(function() {
		APP = {
			scope: {
				visitSchedule: <?= isset($data) ? json_encode($data) : '[]' ?>,
				listSelectBox: <?= isset($listSelectBox) ? json_encode($listSelectBox) : 'null' ?>
			}
		};

		if (APP.scope.listSelectBox) {
			if (APP.scope.listSelectBox.usersConsultant) {
				populateSelectBox({
					list: APP.scope.listSelectBox.usersConsultant,
					target: document.forms.formSchedule.consultant,
					columnValue: "id",
					columnLabel: "name",
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.scope.listSelectBox.city) {
				populateSelectBox({
					list: APP.scope.listSelectBox.city,
					target: document.forms.formSchedule.city_id,
					columnValue: "id",
					columnLabel: "name",
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.scope.listSelectBox.course) {
				populateSelectBox({
					list: APP.scope.listSelectBox.course,
					target: document.forms.formSchedule.course_id,
					columnValue: "id",
					columnLabel: "name",
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.scope.listSelectBox.state) {
				populateSelectBox({
					list: APP.scope.listSelectBox.state,
					target: document.forms.formSchedule.state,
					columnValue: "id",
					columnLabel: "description",
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.scope.listSelectBox.course) {
				populateSelectBox({
					list: APP.scope.listSelectBox.course,
					target: document.forms.formSchedule.course_id,
					columnValue: "id",
					columnLabel: "name_pt",
					emptyOption: {
						label: "Selecione..."
					}
				});
			}
		}

		/* initialize the calendar ------------------------------------------------------*/
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		$('#calendar').fullCalendar({
			locale: "pt-br",
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,listMonth'
				//right: 'month,agendaWeek,agendaDay'
			},
			events: APP.scope.visitSchedule.map(function(item) {
				var dataEvent = {
					'idLead': item.leads_id,
					'idLeadsVisit': item.id,
					'title': item.subject,
					'start': item.visit_date,
					'allDay': true,
				}
				return dataEvent;
			}),
			eventClick: function(calEvent, jsEvent, view) {
				window.location.href = ('/admin/prospection/guestbook/insert/' + calEvent.idLead + '/' + calEvent.idLeadsVisit);
			}
		});
	});
</script>
@endsection
