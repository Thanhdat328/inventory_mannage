@extends('layouts.app')

@section('content')
<div class="container table-responsive">
    <div class="row">
        <div class="col-md-4">
            <h2 class="admin-heading">All User</h2>
        </div>
        <div class="offset-md-6 col-md-2">
            <a class="add-new" href="{{ route('admin.create') }}">Add user</a>
        </div>
    </div>
   <div class="row">
        <div class="col-md-12"></div>
   </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                


                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><strong>{{$user->name}}</strong></td>
                    <td>{{$user->email}}</td>
                    
                    <td class="d-flex">
                        <buton data-sid='{{ $user->id }}>' class="btn btn-outline-primary view-btn2">View</buton>
                        <a class="btn btn-outline-warning view-btn ms-2" href="{{route('admin.edit', $user->id)}}">Edit</a>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div id="modal">
        <div id="modal-form">
            <table cellpadding="10px" width="100%">

            </table>
            <div id="close-btn">X</div>
        </div>
    </div>
</div>


    <script src="{{asset('asset/js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript">
         $(".view-btn2").on("click", function(){
            var user_id = $(this).data("sid");
            console.log(user_id);
            $.ajax({
                url: "http://127.0.0.1:8000/admin/view/"+user_id,
                type: "get",
                success: function(user) {
                    console.log(user);
                    form ="<tr><td> Name :</td><td><b>"+user['name']+"</b></td></tr><tr><td>Email :</td><td><b>"+ user['email']+ "</b></td></tr>";
                    console.log(form);

                    $("#modal-form table").html(form);
                    $("#modal").show();
                }
            });
        });

       
        $('#close-btn').on("click", function() {
            $("#modal").hide();
        });
    </script>
@endsection