$(document).ready(function() {
    $('.token-table').DataTable({
        paging: false,
        searching: false,
        select: true,
        "order": [[ 1, 'asc' ]],
        responsive: true
    });
});
