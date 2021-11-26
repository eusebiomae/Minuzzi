@extends('site.layout.layout')

@section('css')
@parent
{{-- CALENDAR --}}
<link rel="stylesheet" href="{!! asset('css/plugins/fullcalendar/fullcalendar.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/fullcalendar/fullcalendar.print.css') !!}" media='print'/>
@endsection
@section('content')


  @include('site.components.banner')
  <section class="my-5">
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
@endsection

@section('scripts')
@parent

{{-- CALENDAR --}}

<script type="text/javascript" src="{!! asset('js/plugins/fullcalendar/moment.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/plugins/fullcalendar/fullcalendar.js') !!}" ></script>
<script type="text/javascript" src="{!! asset('js/plugins/fullcalendar/locale-all.js') !!}" ></script>
<script>
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
    // events: APP.scope.visitSchedule.map(function(item) {
    //   var dataEvent = {
    //     'idLead': item.leads_id,
    //     'idLeadsVisit': item.id,
    //     'title': item.subject,
    //     'start': item.visit_date,
    //     'allDay': true,
    //   }
    //   return dataEvent;
    // }),
    eventClick: function(calEvent, jsEvent, view) {
      window.location.href = ('/admin/prospection/guestbook/insert/' + calEvent.idLead + '/' + calEvent.idLeadsVisit);
    }
  });
    </script>
@endsection
