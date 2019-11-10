<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(function () {

        var table = $('.data-table').DataTable({
            bFilter: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('posts.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
                {data: 'id', name: 'id', orderable: false},
                {data: 'title', name: 'title', orderable: false},
                {data: 'type', name: 'type', orderable: false},
                {data: 'wysiwyg_text', name: 'wysiwyg_text', orderable: false},
                {data: 'img_location', name: 'img_location', orderable: false},
                {data: 'status', name: 'status', orderable: false,
                    render: function(data, type, full, meta) {
                        var status = {
                            0: {'title': 'Inactive', 'class': ' btn-danger'},
                            1: {'title': 'Active', 'class': ' btn-primary'},
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }

                        return '<button type="button"  onclick="change_status('+ full.id +')" value="'+ data +'" class="btn ' + status[data].class + '">' + status[data].title + '</button>';
                    }
                    },
                {data: 'created_at', name: 'created_at', orderable: false},
                {data: 'updated_at', name: 'updated_at', orderable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],

        });

    });
    function change_status(id) {
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $.ajax({

            type:'POST',

            url:'{{route('changeStatus') }}',

            data:{
                'id':id,
            },

            success:function(data){
                location.reload();


            } });

    }
</script>
