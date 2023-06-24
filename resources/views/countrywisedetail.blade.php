<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-storage.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    

</head>
<body>

    @extends('voyager::master')

    @section('content')

    <table id="user-table" class="table">

                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Country</th>
                        
                        <!-- <th scope="col">Profile</th> -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through the users and generate the table rows -->
                    @foreach ($data['users'] as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $c->name }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
    </table>

    @endsection



        <script>


                    /// Initialize yajra table
                
                    $(document).ready(function () {
                        $('#user-table').DataTable();
                })

                // $(document).ready(function () {
                //     initializeDataTable();
                // });


                function initializeDataTable() {
                    $('#user-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                        url: '/getcountrywiserecords',
                        type: 'GET',
                        data:  {
                            country: countryName
                        },
                        dataType: 'json',
                        },
                        columns: [
                                            {data: 'name', name: 'name'},
                                            {data: 'email', name: 'email'},
                                            {data: 'phone', name: 'phone'},
                                            {data: 'country', name: 'country'},
                                            // {data: 'image', name: 'image'},
                                            
                       
                        ],
                    });
                    };





                /// get name of country from URL
                $(document).ready(function(){
                    // Get the current URL
                    var currentUrl = window.location.href;
                    var url = new URL(currentUrl);
                    var country = url.searchParams.get('country');
                    countryName = country;
                    var countryOption = document.getElementById('countryOption');
                    countryOption.value = country;
                    countryOption.textContent = country;

                })




</script>

        