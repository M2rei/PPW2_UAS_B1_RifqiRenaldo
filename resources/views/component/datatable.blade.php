<!-- DataTables CSS -->
<link rel="stylesheet" href="{{ asset('dataTables.bootstrap5.min.css') }}" />

<!-- DataTables JS -->
@push('customjs')
<script src="{{ asset('jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dataTables.bootstrap5.min.js') }}"></script>
@endpush
<!-- Initialize DataTable -->
<script>
    $(document).ready(function() {
        $('.datatable').DataTable();  // Initialize DataTable pada elemen dengan kelas 'datatable'
    });
    
</script>
