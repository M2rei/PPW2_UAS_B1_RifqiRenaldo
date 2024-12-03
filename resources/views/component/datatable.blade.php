<!-- DataTables CSS -->
<link rel="stylesheet" href="{{ asset('dataTables.bootstrap5.min.css') }}" />

<!-- DataTables JS -->
<script src="{{ asset('jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dataTables.bootstrap5.min.js') }}"></script>

<!-- Initialize DataTable -->
<script>
    $(document).ready(function() {
        $('.datatable').DataTable();  // Initialize DataTable pada elemen dengan kelas 'datatable'
    });
</script>
