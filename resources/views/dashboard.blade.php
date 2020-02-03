<!DOCTYPE html>
<html>
<head>
<title>Dashboard - Tutsmake.com</title>
 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--Bootsrap 4 CDN-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{url('style.css')}}">
</head>
<body>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 mx-auto">
                <h3 class="login-heading mb-4">Welcome {{ ucfirst(Auth()->user()->name) }}!</h3>
                <div class="card">
                    <div class="card-body">
                    <a class="small" href="{{url('logout')}}">Logout</a>
                    <div class="row pull-right">
                        <a href="{{url('/create/user')}}" class="btn btn-success">Create</a>
                    </div>
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $(document).on('click', '.delete', function(){
            user_id = $(this).attr('id');
            console.log("user_id", user_id);
            $.ajax({
                url:"delete/user/"+ user_id,
                type: "DELETE",
                success:function(data) {
                    setTimeout(function(){
                        $('.data-table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            type: "GET",
            ajax: "{{ route('dashboard') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
</html>