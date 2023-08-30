@include('_adminBase')

<body>
    @include('components.adminNavbar')

  
    <section id="reps">

        <h1> Reports</h1>
        <h3 class="input-error" style="margin-top: 1.5rem;" id="form-error">
            <?php
                //  if (!empty($error)) : ?>
                <?php
                //  echo $error; ?>
            <?php 
        // endif; ?>
        </h3>
    @foreach ($reports as $report )
            <div class='row containerrow indgo '>
                <div class="rowheaders">

                    <li>
                        <div class="rowItem">
                            <h3>
                                id
                            </h3>
                            <h4>
                               {{$report->report_id}}
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="rowItem">
                            <h3>
                                name
                            </h3>
                            <h4 id="testname">
                                {{$report->username}}
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="rowItem">
                            <h3>
                                date
                            </h3>
                            <h4 id="testdate">
                                {{$report->date}}
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="rowItem">
                            <h3>
                                type
                            </h3>
                            <h4 id="testtype">
                                {{$report->test_name}}
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class=" rowItem">
                            <h3>
                                email
                            </h3>
                            <h4 id="testemail">
                                {{$report->email}}
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="rowItem">
                            <h3>
                                phone
                            </h3>
                            <h4 id="testphone">
                                {{$report->phone_number}}
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="rowItem">
                            <h3>
                                MRN
                            </h3>
                            <h4 id="testuserId">
                                {{$report->mrn}}
                            </h4>
                        </div>
                    </li>
                    <li>

                        <div class=" rowButtons">
                            <a class="view pointer" href="./view-document/{{$report->url}}" target="_blank">
                                 <img src="{{asset("/assets/icons8-file-24.png")}}">
                            </a>
                            
                            <div class="update-test pointer"
                            data-appoint-id="{{$report->app_id}}"
                            data-report-id="{{$report->report_id}}"
                            data-name="{{$report->username}}"
                            data-email="{{$report->email}}"
                            data-address="{{$report->address}}"
                            data-mrn="{{$report->mrn}}"
                            data-phone="{{$report->phone_number}}"
                            data-date="{{$report->date}}"
                            data-time="{{$report->time}}"
                            data-test="{{$report->test_name}}">

                            
                                <img src=" {{asset("/assets/icons8-modify-20.png")}}">
                            </div>
                            <div class="delete pointer" data-url=" {{$report->url}}" data-id="{{$report->report_id}}"> <img src="{{asset("/assets/icons8-delete-20.png")}}"></div>
                        </div>
                    </li>


                </div>
            </div>
            @endforeach
    
    </section>








    <div id="addtestModal" class="add-modal">
        <div class="add-modal-content">
            <span class="close-add" id="close-add-test">&times;</span>
            <h2>Update Report</h2>
            <form action="index.php" method="POST" enctype="multipart/form-data">

                <label for=""></label>
                <input type="text" id="mrn-input" placeholder="MRN">
                <input type="hidden" id="mrn-input_hidden" name="mrn" placeholder="MRN">
                <label for=""></label>
                <!-- <input type="text" id="app-id" name="app_id" placeholder="appointment-id"> -->
                <select class="select" id="appointment-dropdown" name="app_id">
                    <option value="0">appointment:</option>

                </select>


                <input hidden class="select" id="test-id" name="selected">

                <input type="file" id="myFile" name="report-file" class="file-input">
                <button type="submit" name="add-report" id="add-button-test">Update Report</button>
            </form>
        </div>
    </div>



    <div id="updatetestModal" class="add-modal">
        <div class="add-modal-content">
            <span class="close-add" id="close-update-test">&times;</span>
            <h2>Update Report</h2>
            <form action="{{route("updateFile")}}" method="POST"  enctype="multipart/form-data">
@csrf
           
                <input type="hidden" id="mrn-input" placeholder="MRN">
                <input type="hidden" id="mrn-input_hidden" name="mrn" placeholder="MRN">
           <input type="hidden" id="report_id" name="report_id">

               <input type="hidden" id="update-test_app_id" name="app_id" placeholder="app_id" >
               <input type="hidden" id="update-test__mrn" name="mrn">

                <input type="text" id="update-test__name" name="name" placeholder="name" disabled>
                <input type="text" id="update-test__email" name="email" placeholder="email" disabled>
                <input type="text"  id="update-test-phone" name="phone"disabled >
                <input type="text"  id="update-test-testName" name="testName" disabled>
                <input type="date"  id="update-test__date" name="date" placeholder="date" disabled>
                <input type="text"  id="update-test__time" name="time" placeholder="time" disabled>
                <input type="text"  id="update-test__address" name="address" placeholder="address" disabled>

                <input type="file" id="myFile" name="file" class="file-input">
                <button type="submit" name="add-report" id="add-button-test">Update</button>
            </form>
        </div>
    </div>



    <script defer>
        let updateButtons = document.querySelectorAll('.update-test');

// Get the cancel button element

let updateTestModal = document.getElementById("updatetestModal");
// Get the confirm button element



let closeupdatetest = document.querySelector("#close-update-test");

let addcloseButton = document.querySelector(".choose-modal-close");
// When the user clicks on a delete button, open the modal
let mrnInput = document.getElementById("mrn-input")
let mrnInputHidden = document.getElementById("mrn-input_hidden")
mrnInputAppointment = document.getElementById('update-test__mrn')
updateButtons.forEach(function(updateButton) {
    updateButton.addEventListener("click", function() {
        mrnInput.value = updateButton.dataset.mrn
        mrnInputHidden.value = updateButton.dataset.mrn

        //  mrnInputAppointment.value = addButton.dataset.mrn
     document.getElementById('update-test__name').value = updateButton.dataset.name
     document.getElementById('update-test_app_id').value = updateButton.dataset.appointId
     document.getElementById('update-test__mrn').value = updateButton.dataset.mrn
document.getElementById('report_id').value = updateButton.dataset.reportId
         document.getElementById('update-test__email').value = updateButton.dataset.email
            document.getElementById('update-test-phone').value = updateButton.dataset.phone
            document.getElementById('update-test-testName').value = updateButton.dataset.test
            document.getElementById('update-test__date').value = updateButton.dataset.date
            document.getElementById('update-test__time').value = updateButton.dataset.time
            document.getElementById('update-test__address').value = updateButton.dataset.address
     
        
         console.log(updateButton.dataset.appointId)

        // console.log(updateButton.dataset.mrn);
        updateTestModal.style.display = "block";
    });
});



// When the user clicks on the close button, close the modal
closeupdatetest.addEventListener("click", function() {
    updateTestModal.style.display = "none";
})


window.addEventListener("click", function(event) {
    if (event.target == updateTestModal) {
        updateTestModal.style.display = "none";
    }
});
    </script>





















    <div id="deleteModal" class="modal">
        <form action="{{route("AdmindeleteReport")}}" method="POST" class="modal-content">
            @csrf
            <input type="hidden" id="delete_report_value" name="user_report_id" value="">
            <input type="hidden" id="delete_report_url" name="user_report_url" value="">
            <span class="close">&times;</span>
            <h3>Are you sure you want to delete this record?</h3>
            <div class="modal-buttons">

                <button type="submit" name="delete_report" id="confirmButton">Delete</button>
            </div>
        </form>
    </div>
</body>






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
    let deleteInput = document.getElementById("delete_report_value")
    let deleteUrl = document.getElementById("delete_report_url")

    // When the user clicks on a delete button, open the modal
    deleteButtons.forEach(function(deleteButton) {
        deleteButton.addEventListener("click", function() {
            modal.style.display = "block";
            deleteInput.value = deleteButton.dataset.id;
            deleteUrl.value = deleteButton.dataset.url;

            // Set the row to delete as the parent of the clicked button
            // Store the row to delete as a property of the confirm button
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