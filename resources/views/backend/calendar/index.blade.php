@extends('backend.layout.app')
@section('customCSS')
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.6/index.global.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.6/index.global.min.css" rel="stylesheet" />


<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.6/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.6/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.6/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            editable: true,
            locale: 'tr', 
            buttonText: {
                today: 'Bugün',
                month: 'Ay',
                week: 'Hafta',
                day: 'Gün'
                },// Türkçe dil desteği
                events: '/calendar/events',

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                }
            });

            calendar.render();
        });
</script>
@endsection
@section('content')
<div class="container">
    <div id="calendar"></div>
</div>

@endsection

@section('customJS')


@endsection