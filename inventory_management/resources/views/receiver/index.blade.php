@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container table-responsive">
        <a href="{{route('receiver.create')}}"><i class="fa-solid fa-circle-plus icon-size"></i></a>
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
                    <td class="menu">
                        <button data-sid='{{ $receiver->id }}>' class="view-btn edit-btn"><i class="fa-regular fa-circle-user"></i></button>
                        <a href="{{route('receiver.edit', $receiver->id)}}"><i class="fa-regular fa-pen-to-square"></i></a>
                        <form action="{{route('receiver.delete', $receiver->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="edit-btn" onclick="return confirm('Are you sure you want to delete this task?')"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div id="modal">
            <div id="modal-form">
                <table cellpadding="10px" width="100%">

                </table>
                <div id="close-btn"><i class="fa-regular fa-circle-xmark icon-size"></i></div>
            </div>
        </div>
    </div>


    <script src="{{asset('asset/js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript">
        $(".view-btn").on("click", function() {
            var receiver_id = $(this).data("sid");
            $.ajax({
                url: "http://127.0.0.1:8000/receiver/view/" + receiver_id,
                type: "get",
                success: function(receiver) {
                    console.log(receiver);
                    form = "<tr><td> Name :</td><td><b>" + receiver['name'] + "</b></td></tr><tr><td>Address :</td><td><b>" + receiver['address'] + "</b></td></tr><tr><td>Phone :</td><td><b>" + receiver['phone'] + "</b></td></tr><tr><td>Email :</td><td><b>" + receiver['email'] + "</b></td></tr>";
                    console.log(form);

                    $("#modal-form table").html(form);
                    $("#modal").show();
                }
            });
        });


        $('#close-btn').on("click", function() {
            $("#modal").hide();
        });



        // $(".delete-receiver").on("click", function() {
        //     var s_id = $(this).data("sid");
        //     $.ajax({
        //         url: "delete-receiver.php",
        //         type: "POST",
        //         data: {
        //             sid: s_id
        //         },
        //         success: function(data) {
        //             $(".message").html(data);
        //             setTimeout(function() {
        //                 window.location.reload();
        //             }, 2000);
        //         }
        //     });
        // });
    </script>
</body>

</html>


@endsection