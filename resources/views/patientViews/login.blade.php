@include('_patientBase')

<body>

 
    <script>
    $(document).ready(function() {
      let submit = $("#submit");
      $("#email").on("keyup", function() {
        let errorContainer = $('#email-error')
        setTimeout(() => {
          console.log("hello");
          let inputVal = $(this).val();
          if (inputVal.length > 0 && !(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(inputVal))) {
            $(this).css("border-color", "red");
            errorContainer.text("please enter a valid email")
            submit.prop('disabled', true)
          } else {
            $(this).css('border-color', 'rgb(203, 213, 225)')
            errorContainer.text("")
            submit.prop('disabled', false)
          }
        }, 1000)

      });
      
    });
  </script>
  <div class="signup-page">
    <form action="{{route('handleLogin')}}" class="signup-form" name="POST" method="POST">
@csrf
      <div class="form-container">
        <h1 class="signup-header">User Login</h1>
        @if (session('error'))
        <h3 class="input-error" id="form-error">
            {{ session('error') }}
        </h3>
    @endif
    
    
        <input type="text" placeholder="Email" id="email" name="email" value="{{old('email')}}" />
        @error('email')
          <h3 class="input-error" id="email-error">
            {{$message}}
          </h3>
          
        @enderror
        <h3 class="input-error" id="email-error"></h3>
        <input type="password" style="margin-bottom: 1rem" placeholder="Password" id="password" name="password" value="{{old('password')}}" />
        @error('password')
          <h3 class="input-error" id="password-error">
            {{$message}}
          </h3>
          
        @enderror
        

        <button type="submit" id="submit" class="btn signup-form__btn" name="login" value="Login">
          Submit
        </button>
        <div class="signup__footer">
          you don't have an account?
          <a class="login__link" href="./signup "> sign up </a>
          .
        </div>
      </div>
    </form>
  </div>
</body>

</html>