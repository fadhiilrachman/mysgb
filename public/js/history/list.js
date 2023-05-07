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
        {data: 'title_with_link', name: 'title_with_link'},
        {data: 'user_id', name: 'user_id'},
        {data: 'created_at', name: 'created_at', orderable: false, searchable: false}
    ]
});