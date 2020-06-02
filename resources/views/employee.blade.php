<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .btn-active{
            background-color: green;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="mt-5">
        <div class="add_employee">
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                Добавить сотрудника
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="#" id="add_employee" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name-input">Name</label>
                                    <input type="text" id="name-input" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="address-input">Address</label>
                                    <input type="text" id="address-input" name="address" class="form-control">
                                </div>

                                <select class="browser-default custom-select" name="role_id">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"> {{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 pt-5 pb-2">
                <div class="tab">
                    <button type="button" data-id="1"  class="tab-links btn btn-primary mr-5 btn-active">Менеджер</button>
                    <button type="button" data-id="2" class="tab-links btn btn-primary mr-5">Сотрудник</button>
                    <button type="button" data-id="3" class="tab-links btn btn-primary mr-5">Стажер</button>
                    <button type="button" data-id="4" class="tab-links btn btn-danger mr-9">Неактивные сотрудники</button>
                </div>
                <div id="main">
                    @include('role', ['statuses' => \App\Status::all()])
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $("#add_employee").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('add.employee')}}",
                method: "post",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('#exampleModal').modal('hide');
                    $('#employee_table').append(data.html_data);
                }
            })
        })
        $(document).on('change', '.slc', function (e) {
            let option = $(e.currentTarget);
            let id = option.children('option:selected').data('id');
            let role_id = option.children('option:selected').data('role');
            let empl_id = option.parent().parent('tr').attr('id');
            $.ajax({
                url: "{{ route('change.option') }}",
                method: "post",
                data: {
                    status_id: option.val(),
                    id: id,
                    role_id: role_id,
                },
                 success:data => {
                     $('#' + empl_id).fadeOut('slow', function () {
                         $('#' + empl_id).remove();
                     });
                 }
            })
        })

    })
</script>

<script>
    $('.tab-links').click(function (event) {
        let btn = $(event.currentTarget);
        if (btn.hasClass('btn-active')== false){
            $('.tab-links').removeClass('btn-active');
            btn.addClass('btn-active');
            $.ajax({
                url:'{{ route('tab.employee') }}',
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    role_id: btn.data('id'),
                },
                success: data => {
                    $('#main').html(data.view);
                },

            })
        }

    })
</script>


