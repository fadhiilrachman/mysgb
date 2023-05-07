<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

<link rel="stylesheet" href="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
<link rel="stylesheet" href="{{ asset('/vendors/bootstrap-icons/bootstrap-icons.css') }}">

@if(Route::is('sharing.create-new') )
    <link rel="stylesheet" href="{{ asset('/vendors/choices.js/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/flatpickr/flatpickr.min.css') }}">
@endif

@if(Route::is('sharing.list') )
    <link rel="stylesheet" href="{{ asset('/vendors/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendors/daterangepicker/daterangepicker.min.css') }}" />
@endif

@if(Route::is('sharing.my-list') )
    <link rel="stylesheet" href="{{ asset('/vendors/DataTables/datatables.min.css') }}">
@endif

@if(Route::is('history.view') )
    <link rel="stylesheet" href="{{ asset('/vendors/DataTables/datatables.min.css') }}">
@endif

<link rel="stylesheet" href="{{ mix('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="{{ mix('css/app-dark.css') }}">

@livewireStyles

{{ $style ?? '' }}