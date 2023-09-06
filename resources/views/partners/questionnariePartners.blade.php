@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection


@include('partners.partnerData')

<div class="form-group col-sm-5 ">
    @include('layouts.indextable', ['tableTitle' => 'Csatolt űrlapok'])
</div>

<div class="form-group col-sm-2 d-flex align-items-center">
    <button class="btn btn-danger m-3 unhook">{{ __('Visszavonás') }}</button>
    <button class="btn btn-success m-3 attach">{{ __('Csatolás') }}</button>
</div>

<div class="form-group col-sm-5 ">
    <div class="clearfix"></div>
    <div class="box box-primary mt-3">
        <h4>{{ __('Választható űrlapok') }}</h4>
        <div class="box-body">
            <table class="table table-hover table-bordered notapartner w-100"></table>
        </div>
    </div>
    <div class="text-center"></div>
</div>

@section('scripts')

    @include('functions.js.ajaxsetup')
    @include('functions.js.required')
    @include('functions.js.sweetalert')
    @include('functions.js.dtControl')
    @include('functions.js.readonlyModify')

    <script type="text/javascript">


        $(function () {

            ajaxSetup();

            const partner = {{ $partners->id }};
            const actualUrl = "{{url('/pqEdit/'.$partners->id )}}";

            RequiredBackgroundModify('.form-control')
            ReadonlyBackgroundModify('.form-control')

            var indexTable = $('.indextable').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[0, 'asc']],
                paging: false,
                select: true,
                buttons: [],
                ajax: "{{ route('pqIndex', $partners->id) }}",
                columns: [
                    {title: "{{ __('Űrlap')}}", data: 'questionnarieName', name: 'questionnarieName'},
                    {title: "{{ __('Id')}}", data: 'questionnarieId', name: 'questionnarieId'},
                ],
                columnDefs: [
                    {
                        targets: [1],
                        visible: false
                    }
                ],
            });

            var notAPartnerTable = $('.notapartner').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[0, 'asc']],
                paging: false,
                select: true,
                buttons: [],
                ajax: "{{ route('PartnerQuestionnariesQuestionnarieNotConnected', $partners->id) }}",
                columns: [
                    {title: "{{ __('Űrlap')}}", data: 'name', name: 'name'},
                    {title: "{{ __('Id')}}", data: 'id', name: 'id'},
                ],
                columnDefs: [
                    {
                        targets: [1],
                        visible: false
                    }
                ],
            });

            $('.attach').on('click', function (event) {
                if (notAPartnerTable.rows('.selected').count() > 0) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Biztos, hogy hozzá kapcsolaja a partnereket az űrlaphoz?",
                        text: "Ezután a partner nevében is kiküldi a rendszer ezt az űrlapot az ügyfeleknek!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: "Csatolás",
                        cancelButtonText: "Kilép",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            notAPartnerTable.rows('.selected').every(function () {
                                var data = this.data();
                                //display original data
                                $.ajax({
                                    type: "GET",
                                    url: "{{url('partnerAttachQuestionnarie')}}",
                                    data: {questionnaire: data.id, partner: partner},
                                    success: function (response) {
                                        console.log('Response:', response);
                                        window.location.href = actualUrl;
                                    },
                                    error: function (response) {
                                        console.log('Error:', response);
                                    }
                                });
                            })
                        } else {
                            window.location.href = actualUrl;
                        }
                    })
                } else {
                    sw('Nincs kiválasztott tétel!');
                }
            });

            $('.unhook').on('click', function (event) {
                if (indexTable.rows('.selected').count() > 0) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Biztos, hogy lekapcsolaja a partnereket az űrlaphoz?",
                        text: "Ezután a partner nevében nem kiküldi a rendszer ezt az űrlapot az ügyfeleknek!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: "Visszavonás",
                        cancelButtonText: "Kilép",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            indexTable.rows('.selected').every(function () {
                                var data = this.data();
                                //display original data
                                $.ajax({
                                    type: "GET",
                                    url: "{{url('partnerUnhookQuestionnarie')}}",
                                    data: {questionnaire: data.questionnarieId, partner: partner},
                                    success: function (response) {
                                        console.log('Response:', response);
                                        window.location.href = actualUrl;
                                    },
                                    error: function (response) {
                                        console.log('Error:', response);
                                    }
                                });
                            })
                        } else {
                            window.location.href = actualUrl;
                        }
                    })
                } else {
                    sw('Nincs kiválasztott tétel!');
                }
            });


        });
    </script>
@endsection
