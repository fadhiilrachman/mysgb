<script src="{{ mix('js/app.js') }}"></script>

<script src="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>

@livewireScripts

<script src="{{ asset('/js/main.js') }}"></script>

@if(Route::is('sharing.create-new') )
    <script src="{{ asset('/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('/vendors/choices.js/choices.min.js') }}"></script>
    <script src="{{ asset('/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('/js/sharing/form-editor.js') }}"></script>
@endif

@if(Route::is('sharing.list') )
    <script src="{{ asset('/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/vendors/daterangepicker/daterangepicker.min.js') }}"></script>

    <script src="{{ asset('/vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('/js/sharing/list.js') }}"></script>
@endif

@if(Route::is('sharing.my-list') )
    <script src="{{ asset('/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/vendors/daterangepicker/daterangepicker.min.js') }}"></script>

    <script src="{{ asset('/vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('/js/sharing/my-list.js') }}"></script>
@endif

@if(Route::is('history.view') )
    <script src="{{ asset('/vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('/js/history/list.js') }}"></script>
@endif

@if(Route::is('shield.list') )
    <script src="{{ asset('/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/vendors/daterangepicker/daterangepicker.min.js') }}"></script>

    <script src="{{ asset('/vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('/js/shield/list.js') }}"></script>
@endif

{{ $script ?? ''}}