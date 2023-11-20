<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <!-- Phone -->
    <div>
        <x-input-label for="phone" :value="__('Phone')" />

        <x-text-input id="phone" class="block mt-1 w-full mb-4" type="text" :value="old('phone')" autofocus oninput="sendOTP()" />
        <div id="recaptcha-container"></div>
    </div>

    <!-- OTP -->
    <div class="mt-4 hidden" id="otpSection">
        <x-input-label for="otp" :value="__('Password (OTP)')" />

        <x-text-input id="otp" class="block mt-1 w-full" type="text" />

    </div>

    <x-primary-button class="ml-3 mt-4 hidden" id="otpSection" onclick="verify()">
        {{ __('Verify') }}
    </x-primary-button>

</x-guest-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

<script>
    const firebaseConfig = {
        apiKey: "AIzaSyBVmRcAZUWPyCZYNdoifuPGLrnhGR7KR6E",
        authDomain: "laravel-eco-8168b.firebaseapp.com",
        projectId: "laravel-eco-8168b",
        storageBucket: "laravel-eco-8168b.appspot.com",
        messagingSenderId: "165083299875",
        appId: "1:165083299875:web:4fc47926db7fc38a4df196",
        measurementId: "G-V6GNQZ3K9Z"
    };
    firebase.initializeApp(firebaseConfig);
</script>
<script type="text/javascript">
    window.onload = function() {
        render();
    };

    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }

    function sendOTP() {
        var number = document.getElementById('phone').value
        if (number.length == 10) {
            firebase.auth().signInWithPhoneNumber(`+91${number}`, window.recaptchaVerifier).then(function(confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                console.log(coderesult.verificationId);
                if(coderesult.verificationId != null) {
                    const displayVerificationDOM = document.querySelectorAll('#otpSection');
                    displayVerificationDOM.forEach(displayDOM => {
                        displayDOM.classList.remove('hidden')
                    })
                }
                $("#successAuth").text("Message sent");
                $("#successAuth").show();
            }).catch(function(error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
    }

    function verify() {
        var code = document.getElementById('otp').value
        coderesult.confirm(code).then(function(result) {
            var user = result.user;
            console.log(user);
            $("#successOtpAuth").text("Auth is successful");
            $("#successOtpAuth").show();
        }).catch(function(error) {
            $("#error").text(error.message);
            $("#error").show();
        });
    }
</script>
</body>

</html>