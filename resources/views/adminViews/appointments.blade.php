
@include('_adminBase')

<body>
    @include('components.adminNavbar')


    <section id="appointments">

        <h1>APPOINTMENTS</h1>
        <h3 class="input-error" style="margin-top: 1.5rem;" id="form-error">
            <?
            // php if (!empty($error)) : ?>
            <?
            // php echo $error; ?>
            <?
            // php endif; ?>
        </h3>

        @foreach ($appointments as $appointment)
        <div class='row containerrow indgo' data-id="<?php 
        // echo $appointment['app_id'] ?>">


            <div class=" rowheaders">

                {{-- <li>
                    <div class="rowItem">
                        <h3>
                            id
                        </h3>
                        <h4>
                           {{$appointment->app_id}}
                        </h4>
                    </div>
                </li> --}}
                <li>
                    <div class="rowItem">
                        <h3>
                            name
                        </h3>
                        <h4 id="appointname">
                            {{$appointment->user_name}}
                        </h4>
                    </div>
                </li>

                <li>
                    <div class="rowItem">
                        <h3>
                            type
                        </h3>
                        <h4>
                            {{$appointment->test_name}}
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            email
                        </h3>
                        <h4 id="appointemail">
                            {{$appointment->email}}
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            date
                        </h3>
                        <h4 id="appointmentDate">
                            {{$appointment->date}}
                     
                        </h4>
                    </div>
                </li>
                
                <li>
                    <div class="rowItem">
                        <h3>
                            time
                        </h3>
                        <h4 id="appointmentTime">
                            {{$appointment->time}}
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            phone
                        </h3>
                        <h4 id="appointmentPhone">
                            {{$appointment->phone_number}}
                     
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            appointment-id
                        </h3>
                        <h4 id="appointid">
                            {{$appointment->app_id}}
                        </h4>
                    </div>
                </li>
               
                {{-- <li>
                    <div class=" rowItem">
                        <h3>
                            MRN
                        </h3>
                        <h4 id="appointuserid">
                            {{$appointment->mrn}}
                        </h4>
                    </div>
                </li> --}}
                <li>
                    <div class="rowButtons">

                        <div class="add add-report"
                            id="actions-add-report"
                            data-appoint-id="{{$appointment->app_id}}"
                            data-name="{{$appointment->user_name}}"
                            data-email="{{$appointment->email}}"
                            data-address="{{$appointment->address}}"
                            data-mrn="{{$appointment->mrn}}"
                            data-phone="{{$appointment->phone_number}}"
                            data-date="{{$appointment->date}}"
                            data-time="{{$appointment->time}}"
                            data-test="{{$appointment->test_name}}"

                            >
                            <img src="{{asset('assets/icons8-add-20.png')}}" alt="Add Icon">
                        </div>
                        <div class="update-appoint" data-id="{{$appointment->app_id}}"
                             data-mrn="{{$appointment->mrn}}"
                             data-phone="{{$appointment->phone_number}}">
                            <img src="{{ asset('/assets/icons8-modify-20.png') }}">
                        </div>
                        <div class="delete" data-id="{{$appointment->app_id}}">
                            <img src="{{ asset('/assets/icons8-delete-20.png') }}">
                        </div>
                    </div>
                    
                </li>

            </div>



        </div>
     @endforeach
        

    </section>




    <div id="addtestModal" class="add-modal">
        <div class="add-modal-content">
            <span class="close-add" id="close-add-test">&times;</span>
            <h2>add report</h2>
            <form action="{{route("uploadFile")}}" method="POST"  enctype="multipart/form-data">
@csrf
           
                <input type="hidden" id="mrn-input" placeholder="MRN">
                <input type="hidden" id="mrn-input_hidden" name="mrn" placeholder="MRN">
           

               <input type="hidden" id="add-appointment_app_id" name="app_id" placeholder="app_id" >
               

                <input type="text" id="add-appointment__name" name="name" placeholder="name" disabled>
                <input type="text" id="add-appointment__email" name="email" placeholder="email" disabled>
                <input type="text"  id="add-appointment-phone" name="phone"disabled >
                <input type="text"  id="add-appointment-testName" name="testName" disabled>
                <input type="date"  id="add-appointment__date" name="date" placeholder="date" disabled>
                <input type="text"  id="add-appointment__time" name="time" placeholder="time" disabled>
                <input type="text"  id="add-appointment__address" name="address" placeholder="address" disabled>

                <input type="file" id="myFile" name="file" class="file-input">
                <button type="submit" name="add-report" id="add-button-test">add test</button>
            </form>
        </div>
    </div>




<script>
    // Get the modal element


    // Get all the delete buttons
    let addButtons = document.querySelectorAll('.add');

    // Get the cancel button element

  let addTestModal = document.getElementById("addtestModal");
    // Get the confirm button element



    let closeaddtest = document.querySelector("#close-add-test");

    let addcloseButton = document.querySelector(".choose-modal-close");
    // When the user clicks on a delete button, open the modal
    let mrnInput = document.getElementById("mrn-input")
    let mrnInputHidden = document.getElementById("mrn-input_hidden")
    mrnInputAppointment = document.getElementById('add-appointment__mrn')
    addButtons.forEach(function(addButton) {
        addButton.addEventListener("click", function() {
            mrnInput.value = addButton.dataset.mrn
            mrnInputHidden.value = addButton.dataset.mrn
            mrnInput.disabled = true
            //  mrnInputAppointment.value = addButton.dataset.mrn
         document.getElementById('add-appointment__name').value = addButton.dataset.name
         document.getElementById('add-appointment_app_id').value = addButton.dataset.appointId

             document.getElementById('add-appointment__email').value = addButton.dataset.email
                document.getElementById('add-appointment-phone').value = addButton.dataset.phone
                document.getElementById('add-appointment-testName').value = addButton.dataset.test
                document.getElementById('add-appointment__date').value = addButton.dataset.date
                document.getElementById('add-appointment__time').value = addButton.dataset.time
                document.getElementById('add-appointment__address').value = addButton.dataset.address
                
            
             console.log(addButton.dataset.appointId)

            // console.log(addButton.dataset.mrn);
            addTestModal.style.display = "block";
        });
    });



    // When the user clicks on the close button, close the modal
    closeaddtest.addEventListener("click", function() {
        addTestModal.style.display = "none";
    })


    window.addEventListener("click", function(event) {
        if (event.target == addTestModal) {
            addTestModal.style.display = "none";
        }
    });
</script>







    
    <div id="updateappointModal" class="update-modal">
        <div class="update-modal-content">
            <span class="close-update-appoint">&times;</span>
            <h2>Update appointment</h2>
            <form action="{{route('updateUserAppointment')}}" method="POST">
                @csrf
                <label for="appointnameform"></label>
                <input type="text" name="name" id="appointnameform" placeholder="name" disabled>
                <label for="appointUserIdform"></label>
                <label for="appointIDform"></label>
                <input type="email" id="appointEmailform" name="email" placeholder="email" disabled>
                <input type="text" id="phone" name="phone" placeholder="phone">

                <label for=" appointEmailform"></label>

                <select class="select" name="selected">
                    <option value="0">Test Type:</option>
                    <option value="1">Cardiologists</option>
                    <option value="2">Dermatologists</option>
                    <option value="3">Endocrinologists</option>
                    <option value="4">Gastroenterologists</option>
                    <option value="5">Allergists</option>
                    <option value="6">Immunologists</option>
                </select>
                <label for="time"></label>
                <input name="time" type="time" placeholder="time" id='appointmentTimeForm' name="time" value="">


                <label for="date"></label>
                <input name="date" type="date" id="appointmentDateForm" placeholder=" Date" value="">

                <input type="hidden" id="update-appointment__mrn" value="" name="user_mrn" placeholder="MRN">
                <input type="hidden" id="update-appointment__id" value="" name="app_id" placeholder="MRN">
                <button type="submit" name="update_app" id="updateAppointButton">Update</button>

            </form>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <form action="{{route("deleteUserAppointment")}}" method="POST" class="modal-content">
            @csrf
            <input type="hidden" id="delete_id_input" name="app_id" value="">
            <span class="close">&times;</span>
            <h3>Are you sure you want to delete this record?</h3>
            <div class="modal-buttons">

                <button type="submit" name="delete_app" id="confirmButton">Delete</button>
            </div>
        </form>
    </div>

</body>
<!-- update appointments -->

{{-- 
<script>
    // Get the modal element
    let addmodal = document.getElementById("chooseModal");

    // Get all the delete buttons
    let addButtons = document.querySelectorAll('.add');

    // Get the cancel button element

  let addAppointmodal = document.getElementById("addappointModal");
    // Get the confirm button element



    let closeaddapoint = document.querySelector("#close-add-appoint");

    let addcloseButton = document.querySelector(".choose-modal-close");
    // When the user clicks on a delete button, open the modal
    let mrnInput = document.getElementById("mrn-input")
    let mrnInputHidden = document.getElementById("mrn-input_hidden")
    mrnInputAppointment = document.getElementById('add-appointment__mrn')
    addButtons.forEach(function(addButton) {
        addButton.addEventListener("click", function() {
            mrnInput.value = addButton.dataset.mrn
            mrnInputHidden.value = addButton.dataset.mrn
            mrnInput.disabled = true
            mrnInputAppointment.value = addButton.dataset.mrn
            document.getElementById('add-appointment__name').value = addButton.dataset.name
            document.getElementById('add-appointment__email').value = addButton.dataset.email

            console.log(addButton.dataset.mrn);
            addAppointmodal.style.display = "block";
        });
    });



    // When the user clicks on the close button, close the modal
    closeaddapoint.addEventListener("click", function() {
        addAppointmodal.style.display = "none";
    })


    window.addEventListener("click", function(event) {
        if (event.target == addAppointmodal) {
            addAppointmodal.style.display = "none";
        }
    });
</script> --}}















<script defer>
    // Get the update modal element
    let updateAppointModal = document.querySelector("#updateappointModal");

    // Get all the update buttons
    let updateAppointButtons = document.querySelectorAll('.update-appoint');

    // Get the close button element
    let closeupdateappoint = updateAppointModal.querySelector(".close-update-appoint");

    // Get the update button element
    let updatappointButton = updateAppointModal.querySelector("#updateAppointButton");

    let appointrow = "";

    // When the user clicks on an update button, open the update modal
    updateAppointButtons.forEach(function(updatappointButton) {
        updatappointButton.addEventListener("click", function() {
            updateAppointModal.style.display = "block";
            // Set the row to update as the parent of the clicked button
            let appointRowToUpdate = updatappointButton.parentNode.parentNode.parentNode;

            // Set the input values to the current row values
            let emailInput = updateAppointModal.querySelector("#appointEmailform");
            let appointIdInput = updateAppointModal.querySelector("#appointIdform");
            let userid = updateAppointModal.querySelector("#appointUserIdform");
            let appointusername = updateAppointModal.querySelector("#appointnameform");
            let appointdate = updateAppointModal.querySelector("#appointmentDateForm");
            let appointtime = updateAppointModal.querySelector("#appointmentTimeForm");

            emailInput.value = appointRowToUpdate.querySelector("#appointemail").textContent.trim();
            appointusername.value = appointRowToUpdate.querySelector("#appointname").textContent.trim();
            document.getElementById('update-appointment__mrn').value = updatappointButton.dataset.mrn;
            document.getElementById('update-appointment__id').value = updatappointButton.dataset.id;
            document.getElementById('phone').value = updatappointButton.dataset.phone
            // appointIdInput.value = appointRowToUpdate.querySelector("#appointid").textContent.trim();
            // userid.value = appointRowToUpdate.querySelector("#appointuserid").textContent.trim();
            appointdate.value = appointRowToUpdate.querySelector("#appointmentDate").textContent.trim();
            appointtime.value = appointRowToUpdate.querySelector("#appointmentTime").textContent.trim();
      
            console.log(appointdate.value,appointtime.value);
            // Store the row to update and the update button as properties of the update button
            appointrow = appointRowToUpdate;
        });
    });


    // When the user clicks on the close button, close the update modal
    closeupdateappoint.onclick = function() {
        document.querySelector("#updateappointModal").
        style.display = "none";
    };

    // When the user clicks outside the update modal, close it
    window.addEventListener("click", function(event) {
        if (event.target == updateAppointModal) {
            updateAppointModal.style.display = "none";
        }
    });

    // When the user clicks on the update button, update the row and close the update modal
    updatappointButton.addEventListener("click", function() {

        // Update the row here




        let emailvalue = document.getElementById("appointEmailform").value;
        let appointId = document.getElementById("appointIdform").value;
        let userid = document.getElementById("appointUserIdform").value;
        let nameValue = document.getElementById("appointnameform").value
        // Update the text content of an element with ID "name" inside a row element

        appointrow.querySelector("#appointemail").textContent = emailvalue;

        appointrow.querySelector("#appointid").textContent = appointId;
        appointrow.querySelector("#appointname").textContent = nameValue

        appointrow.querySelector("#appointuserid").textContent = userid;
        updateAppointModal.style.display = "none";
    });
</script>

<script>
    // Get the modal element
    let modal = document.getElementById("deleteModal");

    // Get all the delete buttons
    let deleteButtons = document.querySelectorAll('.delete');

    // Get the cancel button element
    let cancelButton = document.getElementById("cancelButton");

    // Get the confirm button element
    let confirmButton = document.getElementById("confirmButton");

    let closeButton = document.querySelector(".close");

    let deleteIdInput = document.querySelector("#delete_id_input");
    // When the user clicks on a delete button, open the modal
    deleteButtons.forEach(function(deleteButton) {
        deleteButton.addEventListener("click", function() {
            deleteIdInput.value = deleteButton.dataset.id;
            modal.style.display = "block";
            // Set the row to delete as the parent of the clicked button
            let rowToDelete = deleteButton.parentNode.parentNode.parentElement.parentElement;
            // Store the row to delete as a property of the confirm button
            confirmButton.rowToDelete = rowToDelete;
        });
    });

    // When the user clicks on the close button, close the modal
    closeButton.onclick = function() {
        modal.style.display = "none";
    }
    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
</script>