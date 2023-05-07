let getUrl = (params) => {
    return '/sharing/my-list.json' + `?` + $.param(params);
};

let __startDate = moment().subtract(7, 'd'),
    __endDate = moment();

$('input[name=start_date]').val(__startDate.format('YYYY-MM-DD'));
$('input[name=end_date]').val(__endDate.format('YYYY-MM-DD'));

$('input[name="date"]').daterangepicker({
    startDate: __startDate,
    endDate: __endDate,
    opens: 'left'
}, function(start, end, label) {
    $('input[name=start_date]').val(start.format('YYYY-MM-DD'));
    $('input[name=end_date]').val(end.format('YYYY-MM-DD'));
});

let __table = $('table.table-list').DataTable({
    searching: false,
    processing: true,
    serverSide: true,
    ajax: getUrl({
        start_date: $('input[name=start_date]').val(),
        end_date: $('input[name=end_date]').val()
    }),
    columns: [
        {data: 'sharing_id', searchable: false, 
            render: function (data, type, full, meta) {
                return (meta.row+1)+(__table.page.info().page*__table.page.info().length);
            }
        },
        {data: 'title_with_link', name: 'title_with_link'},
        {data: 'created_at', name: 'created_at', orderable: false, searchable: false}
    ]
});

$('form.list').on('submit', (e) => {
    e.preventDefault();
    let __params = {
        start_date: $('input[name=start_date]').val(),
        end_date: $('input[name=end_date]').val()
    };
    if($('input[name=q]').val()!=='') {
        __params['q'] = $('input[name=q]').val();
    }
    $('table.table-list').DataTable().ajax.url(getUrl(__params)).load();

    return false;
});