$(document).ready(function() {
    //check if page has any tables to display
    if($('.token-table').length){
        $('.token-table').DataTable({
            paging: false,
            searching: false,
            select: true,
            "order": [[ 1, 'asc' ]],
            responsive: true
        });
    }
});
