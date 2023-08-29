
@include('_patientBase')
<body>
    @include('components.navbar')


    <section class="contact" id="home">
        <div class=" contact-img-container">
            <img class="contact-img" src="assets/background2.jpg" alt="" />
        </div>
        <div class="contact-content">
            <h1>Medical Tests Carried Out By Our Expert Lab Scientists</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis itaque facilis eveniet numquam
                consequatur sed quam recusandae quos atem.</p>
            <div class="profile-card">


                <div class="profile-card-right-group">


                    <div>
                        <ul class="basic-ul  user-card-right">
                            <li>
                                <p>
                                    <span>name:
                                        <span id="profilename">
                                        {{$patient->username}}
                                        </span>
                                    </span>
                            </li>
                            <li>
                                <p>
                                    <span>email:<span id="profileemail">
                                        {{$patient->email}}
                                        </span>
                                    </span>
                            </li>
                            <li>
                                <p>
                                    <span>age:
                                        <span id="profileage">
                                            {{$patient->age}}
                                        </span>
                                    </span>
                            </li>
                            <li>
                                <p>
                                    <span>from: <span id="profilefrom">
                                        {{$patient->address}}</span>
                                    </span>
                                </p>
                            </li>
                            <li>
                             {{-- <h3 class="input-error" style="width:100%;" id="form-error">
    @if (!empty($error))
        {{ $error }}
    @endif
</h3> --}}

                            </li>


                        </ul>

                    </div>
                    <div class=" update-user-info"><img src={{asset("assets/icons8-modify-20.png")}}>
                    </div>
                </div>
                <div class="name">
                    <div class="welcome">
                        <p>welcome
                            <span>
                                {{$patient->username}}
                            </span> to
                        </p>
                        <h2>EDGE.</h2>
                        <p>we care about your health</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- ///////////////////////////reports///////////////////////////////////////////////////// -->
        <section id="reports" class="sectionStart">
            <div class="title2">
                <h1>reports</h1>
            </div>
            <div class="parent-container">
                <div class="child1-container">
                    @foreach ($reports as $report)


                            <div class='card indgo pointer'>
                                <div class="date-card">
                                  
                                    <div class="day">{{ date('d', strtotime($report->date)) }}</div>
                                    <div>
                                        <div class="month">{{ date('M', strtotime($report->date)) }}</div>
                                        <div class="year">{{ date('Y', strtotime($report->date)) }}</div>
                                    </div>
                                </div>
                                <div class="cardcontent">
                                    <h2>{{ $report->test_name }}</h2>
                                    <p>
                                        This is a {{ $report->test_name }} test taken on {{ $report->date }} at {{ $report->time }} you can check the results of your test from here
                                        <span style="margin-top:0.8rem; display:block; color:black;">
                                            <a href="{{ route('viewDocument', ['url' => $report->url]) }}" target="_blank"> click here to view report</a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    <!-- 
                    <div class='card indgo pointer'>
                        <div class="date-card">
                            <div class="day">21</div>
                            <div>
                                <div class="month">September</div>
                                <div class="year">2017</div>
                            </div>
                        </div>
                        <div class="cardcontent">
                            <h2> $testType</h2>
                            <p>Lisque persius interesset his et, in quot quidam persequeris vim,
                                ad mea essent possim iriure.
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </section>
        
        
<section id="appiontments" class="sectionStart">
    <div class="report" id="appointments">
        <div class="title">
            <h1>appointments</h1>
        </div>
        <h3 class="input-error" style="margin-top: 1.5rem; width: 100%; text-align: center;" id="form-error">
            {{-- @if (!empty($error))
                {{ $error }}
            @endif --}}
        </h3>
        <div class="parent-container">
            <div class="chhild2-container">
                @foreach ($appointments as $appointment)
                <div class='card indgo pointer' data-id="{{ $appointment->app_id }}">
                    <div class="date-card">
                        <div class="day">{{ date('d', strtotime($appointment->date)) }}</div>
                        <div>
                            <div class="month">{{ date('M', strtotime($appointment->date)) }}</div>
                            <div class="year">{{ date('Y', strtotime($appointment->date)) }}</div>
                        </div>
                    </div>
                    <div class="cardcontent">
                        <h2>{{ $appointment->test_name }}</h2>
                        <p>
                            You have an appointment on {{ $appointment->date }} at
                            {{ $appointment->time }} for a {{ $appointment->test_name }} test
                        </p>
                        <div class="download">
                            <div class="rowButtons">
                                <div class="update" data-id="{{ $appointment->app_id }}"
                                    data-phone="{{ $appointment->phone_number }}"><img src={{asset("assets/icons8-modify-20.png")}}></div>
                                <div class="delete" data-id="{{ $appointment->app_id }}"><img src={{asset("assets/icons8-delete-20.png")}}></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


        <footer class="footer" id="contact">
            <div class="footer-container">
                <div class="footer-contact-us">
                    <h3>Contact Us</h3>
                    <ul>
                        <li>2946 Angus Road, NY</li>
                        <li>+31 123 456 7890</li>
                        <li>contact@edge.com</li>
                    </ul>
                </div>
                <div class="footer-account">
                    <h3>Account</h3>
                    <ul>
                        <li>Sign in</li>
                        <li>Create account</li>
                        <li>IOS App</li>
                        <li>Android App</li>
                    </ul>
                </div>
                <div class="footer-company">
                    <h3>Company</h3>
                    <ul>
                        <li>About Us</li>
                        <li>Services</li>
                        <li>Our Team</li>
                        <li>Contacts</li>
                    </ul>
                </div>
                <div class="footer-legal">
                    <h3>LEGAL</h3>
                    <ul>
                        <li>Claims</li>
                        <li>Privacy</li>
                        <li>Terms</li>
                        <li>Policies</li>
                    </ul>
                </div>


                <div class="footer-subscribe">
                    <h3>SUBSCRIBE TO OUR NEWSLETTER</h3>
                    <p>The latest news, articles, and resources, sent to your inbox weekly.</p>
                    <div class="subscribe-actions">
                        <input type="email" placeholder="Enter your email address">
                        <button class="btn btn-subscribe">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <h3>EDGE</h3>
                <p class="footer__copyright">
                    &copy; Copyright by
                    <a class="footer__link twitter-link" target="_blank"
                        href="https://twitter.com/ibrahim_askar11">Ibrahim
                        Askar </a>All rights reserved
                </p>
            </div>
            </div>
        </footer>



        <div id="deleteModal" class="modal">
            <form action="{{ route('deleteAppointments') }}" method="POST" class="modal-content">
                @csrf
                <input type="hidden" id="delete_id_input" name="app_id" value="">
                {{-- <input type="hidden" name="mrn" value="{{ $mrn }}"> --}}
                <span class="close">&times;</span>
                <h3>Are you sure you want to delete this record?</h3>
                <div class="modal-buttons">
                    <button type="submit" name="delete_app" id="confirmButton">Delete</button>
                </div>
            </form>
        </div>



        <!-- The update modal form -->
        <div id="updateModal" class="update-modal">
            <div class="update-modal-content">
                <span class="closeupdate">&times;</span>
                <h2>Update Appointment</h2>
                <form action="{{ route('updateAppointments') }}" method="POST">
                    @csrf
                    {{-- <input type="hidden" name="mrn" value="{{ $mrn }}"> --}}
                    <label for="appointmentid"></label>
                    <input type="hidden" id="appIdForm" placeholder="appointment-id" name="appointmentid">
                    <label for="email"></label>
                    <input type="email" disabled value="{{ $patient->email }}" id="emailform" name="email" placeholder="email">
                    <label for="phone"></label>
                    <input type="tel" id="phoneform" name="phone" placeholder="phone">
@error('phone')
        <h3 class="input-error" id="phone-error">{{$message}}</h3>
    @enderror
    


                    <label for="select"></label>
                    <select class="select" name="selected">
                        <option value="0" {{ old('selected') == '0' ? 'selected' : '' }}>Test Type:</option>
                        <option value="1" {{ old('selected') == '1' ? 'selected' : '' }}>Cardiologists</option>
                        <option value="2" {{ old('selected') == '2' ? 'selected' : '' }}>Dermatologists</option>
                        <option value="3" {{ old('selected') == '3' ? 'selected' : '' }}>Endocrinologists</option>
                        <option value="4" {{ old('selected') == '4' ? 'selected' : '' }}>Gastroenterologists</option>
                        <option value="5" {{ old('selected') == '5' ? 'selected' : '' }}>Allergists</option>
                        <option value="6" {{ old('selected') == '6' ? 'selected' : '' }}>Immunologists</option>
                    </select>
                    @error('selected')
        <h3 class="input-error" id="phone-error">{{$message}}</h3>
    @enderror
                    
                    <label for="time"></label>
                    <input name="time" type="time" value="{{count($appointments) > 0? date('H:i', strtotime($appointment->time)):"" }}" placeholder="time">
                    @error('time')
        <h3 class="input-error" id="phone-error">{{$message}}</h3>
    @enderror
                    <label for="date"></label>
                    <input name="date" value="{{count($appointments) > 0? date('Y-m-d', strtotime($appointment->date)):"" }}" type="date" placeholder="Date">

                    @error('date')
        <h3 class="input-error" id="phone-error">{{$message}}</h3>
    @enderror
                    <button type="submit" name="update_user" id="updateButton">Update</button>
                </form>
                
            </div>
        </div>

        <div id="editUserInfo" class="edit-modal">
<div style="display: none">
{{ $formattedDate = date('Y-m-d', strtotime($patient->birthdate))}}

      </div>      <div class="edit-modal-content">
                <span class="close-edit" id="close-user-info">&times;</span>
                <h2>Edit Info</h2>
                <form action="{{ route('updateUserInfo') }}" method="POST">
@csrf
{{-- <input type="hidden" name="mrn" value="{{ $mrn }}"> --}}
                    <label for=""></label>
                  
                    <input type="text" id="editusername" name="username_input" placeholder="name">
                    @error('username_input')
         <h3 class="input-error" id="name-error">{{$message}}</h3>
     @enderror
                    <label for=""></label>
                    <input type="text" id="edituseremail" name="email_input" placeholder="email">
                    @error('email_input')
            <h3 class="input-error" id="email-error">{{$message}}</h3>
        @enderror
                    <label for=""></label>
                    <input type="date" value="{{$formattedDate}}" id="edituserage" name="date_input"
                        placeholder="age">
                        @error('date_input')
                        <h3 class="input-error" id="email-error">{{$message}}</h3>
                    @enderror
                        <label for=""></label>
                    <input type="text" id="edituserfrom" name="address_input" placeholder="from">

                    @error('address_input')
                    <h3 class="input-error" id="email-error">{{$message}}</h3>
                @enderror
                    <h3 class="changing-password pointer">change password</h3>
                    <button type="submit" name="edit_user" id="edit-user-info-button">Submit Info</button>

                </form>
            </div>
        </div>
        <div id="change-password" class="edit-modal">
            <div class="edit-modal-content">
                <span class="close-edit" id="close-change-password">&times;</span>
                <h2>change the password</h2>
                <form action="{{route('updatePassword')}}" method="POST">
@csrf
    {{-- <input type="hidden" name="mrn" value="{{ $mrn }}"> --}}

                    <label for="current_password"></label>
                    <input type="password" id="" name="current_password" placeholder="Current password">
                    @error('current_password')
        <h3 class="input-error" id="current-password-error">{{$message}}</h3>
    @enderror
                    <label for="new_password"></label>
                    <input type="password" id="" name="new_password" placeholder="New password ">
                    @error('new_password')
        <h3 class="input-error" id="current-password-error">{{$message}}</h3>
    @enderror




                    <button type="submit" name="update_password" id="confirm-change-password">change</button>

                </form>
            </div>
        </div>
</body>

<script defer>
const btn = document.querySelector(".navbar-btn");
btn.onclick = function() {
    if (document.querySelector('.navbar-mobile').style.display !== "none") {
        document.querySelector('.navbar-mobile').style.display = "none";
    } else {
        document.querySelector('.navbar-mobile').style.display = "block";
    }
};
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
// When the user clicks on a delete button, open the modal
deleteButtons.forEach(function(deleteButton) {
    deleteButton.addEventListener("click", function() {
        document.getElementById('delete_id_input').value = deleteButton.dataset.id;
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
    // Check if the target of the click event is the modal
    if (event.target === modal) {
        // Hide the modal
        modal.style.display = "none";
    }
})
// When the user clicks on confirm, delete the row and close the modal
confirmButton.onclick = function() {
    // Delete the row here
    let rowToDelete = confirmButton.rowToDelete;
    rowToDelete.parentNode.removeChild(rowToDelete);
    modal.style.display = "none";
};
</script>

<script defer>
// Get the update modal element
let updateModal = document.getElementById("updateModal");

// Get all the update buttons
let updateButtons = document.querySelectorAll('.update');

// Get the close button element
let closeupdate = updateModal.querySelector(".closeupdate");

// Get the update button element
let updateButton = updateModal.querySelector("#updateButton");
let row = ""
// When the user clicks on an update button, open the update modal
updateButtons.forEach(function(updateButton) {
    updateButton.addEventListener("click", function() {
        updateModal.style.display = "block";
        console.log(updateButton.dataset);
        document.getElementById("phoneform").value = updateButton.dataset.phone;
        document.getElementById("appIdForm").value = updateButton.dataset.id;
        document.getElementById("appIdForm_hidden").value = updateButton.dataset.id;
        document.getElementById("appIdForm").disabled = true;

        // Set the row to update as the parent of the clicked button
        let rowToUpdate = updateButton.parentNode.parentNode.parentElement.parentElement;
        // Set the input values to the current row values

        row = rowToUpdate;

    });
});


closeupdate.onclick = function() {
    updateModal.style.display = "none";
};


window.onclick = function(event) {
    if (event.target == updateModal) {
        updateModal.style.display = "none";
    }
};


updateButton.addEventListener("click", function() {



    document.getElementById("updateModal").style.display = "none";
});
</script>

<!-- Include ScrollReveal.js -->
<script>
let userinfomodal = document.getElementById("editUserInfo");
let closeUserInfo = document.getElementById("close-user-info");
let infoToUpdate = ""
let submitNewInfo = document.getElementById("edit-user-info-button")
let editButton = document.querySelector(".update-user-info")
editButton.addEventListener("click", function() {
    userinfomodal.style.display = "block";
    infoToUpdate = editButton.parentElement
    console.log(infoToUpdate.querySelector("#profilename"))
    document.getElementById("editusername").value = infoToUpdate.querySelector("#profilename").textContent
    .trim();
    document.getElementById("edituseremail").value = infoToUpdate.querySelector("#profileemail").textContent
        .trim();
    // document.getElementById("edituserage").value = infoToUpdate.querySelector("#profileage").textContent.trim();
    document.getElementById("edituserfrom").value = infoToUpdate.querySelector("#profilefrom").textContent
    .trim();

})


window.onclick = function(event) {
    if (event.target == userinfomodal) {
        userinfomodal.style.display = "none";
    }
};


closeUserInfo.onclick = function() {
    userinfomodal.style.display = "none";
};
submitNewInfo.addEventListener("click", function() {

    userinfomodal.style.display = "none";

})
</script>
<script>
let changePasswordModal = document.getElementById("change-password");
let closeChangePassword = document.getElementById("close-change-password");
let confirmChangePassword = document.getElementById("confirm-change-password");
let changingthePassord = document.querySelector(".changing-password");
changingthePassord.addEventListener("click", function() {
    changePasswordModal.style.display = "block";
});
window.addEventListener("click", function(event) {
    // Check if the target of the click event is the modal
    if (event.target === changePasswordModal) {
        // Hide the modal
        changePasswordModal.style.display = "none";
    }
})
closeChangePassword.onclick = function() {
    changePasswordModal.style.display = "none";
}
// When the user clicks on confirm, delete the row and close the modal
confirmChangePassword.onclick = function() {
    // Delete the row here

    changePasswordModal.style.display = "none";
};
// 
</script>