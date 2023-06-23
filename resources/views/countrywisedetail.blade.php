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
<table id="user-table" class="table">

                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Country</th>
                        <th scope="col">Action</th>
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
                            <td>
                                <!-- Add action buttons here as needed -->
                                <button class="btn btn-sm btn-info" onclick="viewClicked('{{ $user->id }}')" >View</button>
                                <button class="btn btn-sm btn-info" onclick="editClicked('{{ $user->id }}')">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteClicked('{{ $user->id }}')">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
    </table>




                 <!-- Create New User Button -->
                        <button  class="btn btn-create"  id="createUserBtn">Create New User</button>

                <!-- Bootstrap Modal Popups to perform Crud Operations -->

                <!-- PopUp Modal to create a new User  -->
                <div class="modal" tabindex="-1" id="createUserPopup">
                    <div class="modal-dialog">
                        <div class="modal-content" style="align-items: center;">
                            <h2>User Form</h2>
                        <form id="createUserForm"  enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="createPopupName" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input id="createPopupEmail" name="email" required></input>
                            </div>
                            <div class="form-group">
                                <label for="phone">Password:</label>
                                <input id="createPopupPassword" name="password" required></input>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input id="createPopupPhone" name="phone" required></input>
                            </div>
                            <div class="form-group">
                                <!-- <label for="country">Country:</label>
                                <input id="createPopupCountry" name="country" required></input> -->
                                <select name="country" id="createPopupCountry">
                                <option disable selected>Country</option>
                                    <option value="" id="countryOption"></option>
                                    
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="description">Profile:</label>
                                <input type="file" name="profile_image" id="createPopupImage">
                                <input type="hidden" name="image_url" id="imageURLInput">
                            </div>
                            <input type="submit"   class="button" value="submit">
                            <!-- onclick="uploadAndSubmit()" -->
                        </form>
                        </div>
                    </div>
                </div>


                    <!-- PopUp Modal to Update a  User's Record  -->
                <div class="modal" tabindex="-1" id="editUserPopup">
                    <div class="modal-dialog">
                        <div class="modal-content" style="align-items: center;">
                            <h2>User Form</h2>
                        <form >
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="editPopupName" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input id="editPopupEmail" name="email" required></input>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input id="editPopupPhone" name="phone" required></input>
                            </div>
                            <div class="form-group">
                                <label for="country">Country:</label>
                                <input id="editPopupCountry" name="country" required></input>
                            </div>
                            <!-- <div class="form-group">
                                <label for="description">Profile:</label>
                                <img src="#" alt="Profile Image">
                            </div> -->
                            <button type="button" id="saveChangesPopup">Save</button>
                        </form>
                        </div>
                    </div>
                </div>


                    <!-- PopUp Modal to View  a  User's Data  -->
                <div class="modal" tabindex="-1" id="viewUserPopup">
                    <div class="modal-dialog">
                        <div class="modal-content" style="align-items: center;">
                            <h2>User Form</h2>
                        <form >
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="viewPopupName" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input id="viewPopupEmail" name="email" required></input>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input id="viewPopupPhone" name="phone" required></input>
                            </div>
                            <div class="form-group">
                                <label for="country">Country:</label>
                                <input id="viewPopupCountry" name="country" required></input>
                            </div>
                            <!-- <div class="form-group">
                                <label for="description">Profile:</label>
                                <img src="#" alt="Profile Image">
                            </div> -->
                            <button type="button" id="viewChangesPopup">Done</button>
                        </form>
                        </div>
                    </div>
                </div>

                </section>



















        
    

        



               <!-- Handling Crud operations on Table -->

        <script>
                var table;
                var userId =0;
                var countryName="";


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
                                            {data: 'action', name: 'action', orderable: false, searchable: false}
                       
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






        // Handle Delete Operation
                function deleteClicked(uId) {
                    var csrfToken = "{{ csrf_token() }}";
                    $.ajax({
                        url: '/deletecrud/' + uId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                                table.destroy();
                                    // Reinitialize the DataTable with the updated data
                                    table = $('#user-table').DataTable({
                                        data: response.data,
                                        columns: [
                                            {data: 'name', name: 'name'},
                                            {data: 'email', name: 'email'},
                                            {data: 'phone', name: 'phone'},
                                            {data: 'country_id', name: 'country_id'},
                                            // {data: 'image', name: 'image'},
                                            {data: 'action', name: 'action', orderable: false, searchable: false}
                                        ]
                                    });
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.log(error);
                        }
                    });
                }




                    // Show PopUp on clicking  New User Button
                $('#createUserBtn').on('click', function () {
                    $('#createUserPopup').show();
                });

                    // Handle Create New User Operation
                $(document).ready(function() {
                $('#createUserForm').submit(function(event) {
                    event.preventDefault(); // Prevent the default form submission
                    
                    var formData = new FormData(this); // Create a new FormData object with the form data
                    console.log(formData);
                    $.ajax({
                    type: 'POST',
                    url: '/countrywiseusers',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle successful response
                        console.log(response);
                        console.log("response success");
                        $('#user-table').DataTable().destroy();
                        initializeDataTable(countryName);
                       
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                    });
                        $('#createPopupName').val('');
                        $('#createPopupEmail').val('');
                        $('#createPopupPhone').val('');
                        // $('#createPopupCountry').val('');
                        $('#createPopupPassword').val('');
                        $('#imageURLInput').val('');
                        $("#createUserPopup").hide();
                    });
                });




                    // Image Upload to Firebase
                $(document).ready(function() {
                    $('#createPopupImage').change(function() {
                            console.log("now in upload to firebase function");
                            var image = document.getElementById("createPopupImage").files[0];
                            var img = image.name;


                            // Initialize Firebase app
                            const firebaseConfig = {
                            apiKey: "AIzaSyCsJALsE6AEPvhLKo1HUYSPyzyo-0yQ6oU",
                            authDomain: "t-1-userauth.firebaseapp.com",
                            // databaseURL: "https://t-1-userh-default-rtdb.firebaseio.com",
                            projectId: "t-1-userauth",
                            storageBucket: "t-1-userauth.appspot.com",
                            // messagingSenderId: "5823983",
                            appId: "1:58239891333:web:f13a680d6254e91296f6ec",
                            
                            };

                            firebase.initializeApp(firebaseConfig);
                             var imageUploadPath = firebase.storage().ref('images/' + img);
                             var imageUpload = imageUploadPath.put(image);
                            
                            imageUpload.then((path)=>{
                                return path.ref.getDownloadURL();
                                console.log("got url after uploading ");
                            }).then((url)=>{
                                imageUrl = url;
                                document.getElementById('imageURLInput').value = imageUrl;
                                console.log(url);
                                    
                            }).catch((error)=>{
                                console.log(error);
                        });
                    });
                });


                    // Will save updated Data to Database
                $('#saveChangesPopup').on('click', function() {
                    // Get the updated values from the input fields in the popup
                    var newName = $('#editPopupName').val();
                    var newEmail = $('#editPopupEmail').val();
                    var newPhone = $('#editPopupPhone').val();
                    var newPassword = $('#editPopupPassword').val();
                    var newCountry = $('#editPopupCountry').val();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    
                    $.ajax({
                        url: '/updateuser/' + userId,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            name: newName,
                            email: newEmail,
                            password: newPassword,
                            phone: newPhone,
                            country: newCountry
                        },
                        success: function(response) {
                            // Re-Initialize Table if Response == Success
                                    table.destroy();
                                        table = $('#user-table').DataTable({
                                            data: response.data,
                                            columns: [
                                                {data: 'name', name: 'name'},
                                                {data: 'email', name: 'email'},
                                                {data: 'phone', name: 'phone'},
                                                {data: 'country_id', name: 'country_id'},
                                                // {data: 'image', name: 'image'},
                                                {data: 'action', name: 'action', orderable: false, searchable: false}
                                            ]
                                        });
                                $('#editUserPopup').hide();
                                // $('#createPopupName').val('');
                                // $('#createPopupEmail').val('');
                                // $('#createPopupPhone').val('');
                                // $('#createPopupCountry').val('');
                        },
                        error: function(xhr, status, error) {
                            // Handle the error response
                            console.log('Error saving changes:', error);
                        }
                    });
                });


                // Will Populate Data in Form to Edit
                function editClicked(uid){
                        userId = uid;
                        $.ajax({
                            url: '/fetchuserdata/' + uid, 
                            type: 'GET',
                            success: function(response) {
                                
                                var name = response.name;
                                var email = response.email;
                                var phone = response.phone;
                                var country = response.country;
                                
                                $('#editPopupName').val(name);
                                $('#editPopupEmail').val(email);
                                $('#editPopupPhone').val(phone);
                                $('#editPopupCountry').val(country);

                                // Open the popup
                                $('#editUserPopup').show();
                            },
                            error: function(xhr, status, error) {
                                // Handle error response
                                console.log(error);
                            }
                        });
                    }

                    $("#viewChangesPopup").on('click', ()=>{
                        $('#viewUserPopup').hide();
                    });
                        //Will fetch and Populate Data in Form to View
                function viewClicked(uid){
                        userId = uid;
                        console.log(uid);
                            // Perform AJAX request to fetch user data
                            $.ajax({
                                url: '/fetchuserdata/' + userId, 
                                type: 'GET',
                                success: function(response) {

                                    var name = response.name;
                                    var email = response.email;
                                    var phone = response.phone;
                                    var country = response.country;
                              
                                    $('#viewPopupName').val(name);
                                    $('#viewPopupEmail').val(email);
                                    $('#viewPopupPhone').val(phone);
                                    $('#viewPopupCountry').val(country);

                                    // Open the popup
                                    $('#viewUserPopup').show();
                                },
                                error: function(xhr, status, error) {
                                    console.log(error);
                                }
                            });
                        }





                    // Appply filters on Yajra Table
                        $('#filterbtn').on('click', function () {
                    
                            // table.clear();
                            $.ajax({
                                url: '/applyfilters',
                                type: 'GET',
                                data: {
                                    country: $('#countryfilter').val(),
                                    startdate: $('#startdatefilter').val(),
                                    enddate: $('#enddatefilter').val()
                                },
                                success: function (response){
                                    table.destroy();
                                        table = $('#user-table').DataTable({
                                            data: response.data,
                                            columns: [
                                                {data: 'name', name: 'name'},
                                                {data: 'email', name: 'email'},
                                                {data: 'phone', name: 'phone'},
                                                {data: 'country_id', name: 'country_id'},
                                                // {data: 'image', name: 'image'},
                                                {data: 'action', name: 'action', orderable: false, searchable: false}
                                            ]
                                        });
                                },
                                error: function(xhr, status,error){
                                    console.log(error);
                                }
                            });
                        });


            </script>
        


   
</body>
</html>



    

    



    

    


    
   

    

