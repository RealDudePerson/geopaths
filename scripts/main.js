$(document).ready(function() {
  $(".token-table").length && $(".token-table").DataTable({
    paging: !1,
    searching: !1,
    select: !0,
    order: [
      [1, "asc"]
    ],
    responsive: !0
  })
});
