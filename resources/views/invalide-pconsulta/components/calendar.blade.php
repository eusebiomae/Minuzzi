@section('css')
@parent
{{-- CALENDAR --}}
<link rel="stylesheet" href="{!! asset('css/plugins/fullcalendar/fullcalendar.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/fullcalendar/fullcalendar.print.css') !!}" media='print'/>
@endsection

<section class="my-5">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 ibox-content">
				<div id="calendar"></div>
			</div>
		</div>
	</div>
</section>

@section('scripts')
@parent

{{-- CALENDAR --}}
<script type="text/javascript" src="{!! asset('js/plugins/fullcalendar/moment.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/plugins/fullcalendar/fullcalendar.js') !!}" ></script>
<script type="text/javascript" src="{!! asset('js/plugins/fullcalendar/locale-all.js') !!}" ></script>
<script>

  $('#calendar').fullCalendar({
    locale: "pt-br",
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,listMonth'
    },
    events: {!! $calendar !!},
    eventClick: function(calEvent, jsEvent, view) {
      console.log(calEvent, jsEvent, view);
      // window.location.href = ('/admin/prospection/guestbook/insert/' + calEvent.idLead + '/' + calEvent.idLeadsVisit);
    }
  });
    </script>
@endsection
