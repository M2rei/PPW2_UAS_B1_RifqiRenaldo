<!-- DataTables CSS -->
<link rel="stylesheet" href="{{ asset('dataTables.bootstrap5.min.css') }}" />

<!-- DataTables JS -->
@push('customjs')
    <script src="{{ asset('jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dataTables.bootstrap5.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable pada elemen dengan kelas 'datatable'
            $('.datatable').DataTable({
                paging: true,           // Menampilkan paginasi
                searching: true,        // Menampilkan fitur pencarian
                responsive: true,       // Membuat tabel responsif
            });
        });
    </script>
@endpush
