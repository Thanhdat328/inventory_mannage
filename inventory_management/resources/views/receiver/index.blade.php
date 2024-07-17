@extends('layouts.app')

@section('content')
<div class="container table-responsive">
    <div class="row">
        <div class="col-md-4">
            <h2 class="admin-heading">All Receiver</h2>
        </div>
        <div class="offset-md-6 col-md-2">
            <a class="add-new btn btn-outline-primary" href="{{ route('receiver.create') }}">Add receiver</a>
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
                <th>Phone</th>


                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receivers as $receiver)
                <tr>
                    <td><strong>{{$receiver->name}}</strong></td>
                    <td>{{$receiver->email}}</td>
                    <td>{{$receiver->phone}}</td>
                    <td class="d-flex">
                        <buton data-sid='{{ $receiver->id }}>' class="btn btn-outline-primary view-btn1">View</buton>
                        <a class="btn btn-outline-warning view-btn ms-2" href="{{route('receiver.edit', $receiver->id)}}">Edit</a>
                        <form action="{{route('receiver.delete', $receiver->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger view-btn ms-2" onclick="return confirm('Are you sure you want to delete this user?')"> delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $receivers->links()}}
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
         $(".view-btn1").on("click", function(){
            var receiver_id = $(this).data("sid");
            $.ajax({
                url: "http://127.0.0.1:8000/receiver/view/"+receiver_id,
                type: "get",
                success: function(receiver) {
                    console.log(receiver_id);
                    console.log(receiver);
                    form ="<tr><td> Name :</td><td><b>"+receiver['name']+"</b></td></tr><tr><td>Address :</td><td><b>"+receiver['address']+"</b></td></tr><tr><td>Phone :</td><td><b>"+ receiver['phone']+ "</b></td></tr><tr><td>Email :</td><td><b>"+ receiver['email']+ "</b></td></tr>";
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