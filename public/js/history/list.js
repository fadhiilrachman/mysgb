let __table = $('table.table-list').DataTable({
    searching: false,
    processing: true,
    serverSide: true,
    ajax: '/history/list.json',
    columns: [
        {data: 'status_code', searchable: false, 
            render: function (data, type, full, meta) {
                return (meta.row+1)+(__table.page.info().page*__table.page.info().length);
            }
        },
        {data: 'type', name: 'type'},
        {data: 'ip', name: 'ip'},
        {data: 'created_at', name: 'created_at', orderable: false, searchable: false}
    ]
});