<script type="text/javascript">
    $(function () {

        ajaxSetup();

        RequiredBackgroundModify('.form-control')
        ReadonlyBackgroundModify('.form-control')

        var table = $('.indextable').DataTable({
            serverSide: true,
            scrollY: 390,
            scrollX: true,
            order: [[0, 'desc'], [1, 'asc'], [2, 'asc']],
            paging: false,
            buttons: [],
            ajax: "{{ route('cqIndex', ['id' => $clients->id]) }}",
            columns: [
                // {title: '', data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                {title: 'Küldve', data: 'posted', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'posted'},
                {title: "{{ __('Partner')}}", data: 'partnerName', name: 'partnerName'},
                {title: "{{ __('Űrlap')}}", data: 'questionnarieName', name: 'questionnarieName'},
                {title: 'Válaszolt', data: 'retrieved', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'retrieved'},
            ]
        });


    });
</script>
