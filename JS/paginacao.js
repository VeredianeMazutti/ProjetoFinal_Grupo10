$(document).ready(function () {
    $('.dataTable').dataTable(
        {
        language: {
            url: '//cdn.datatables.net/plug-ins/2.3.4/i18n/pt-BR.json',
        },
        pageLength:5,
        lengthMenu:[5,10,15,25,50,100],
        responsive:true,
        }
    );
});