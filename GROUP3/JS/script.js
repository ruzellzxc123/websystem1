// 1. Password Visibility Toggle
const eyeIcon = $('.eye-icon');
const passwordInput = $('#password');

eyeIcon.on('click', function() {
    // Toggle the type attribute
    const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
    passwordInput.attr('type', type);
    
    // Toggle the icon (from show to hide)
    eyeIcon.toggleClass('bx-show');
    eyeIcon.toggleClass('bx-hide');
});

// 2. Form Submission Handling
const loginForm = $('#loginForm');
const signInBtn = $('.sign-in-btn');

loginForm.on('submit', function(e) {
    e.preventDefault(); // Prevent page refresh

    const email = $('#email').val();
    const password = passwordInput.val();

    // Visual feedback (Loading state)
    signInBtn.text("Connecting...");
    signInBtn.css("opacity", "0.7");
    signInBtn.prop("disabled", true);

    console.log("Attempting login for:", email);

    // Make actual API call to backend using jQuery AJAX
    $.ajax({
        url: 'API/login.php',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ email: email, password: password }),
        success: function(data) {
            if (data.success) {
                console.log("Login successful:", data);
                // Redirect to dashboard
                window.location.href = 'dashboard.php';
            } else {
                alert(data.message || 'Login failed. Please try again.');
                console.log("Login failed:", data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Connection error:', error);
            console.log('Status:', status);
            console.log('XHR:', xhr.responseText);
            let errorMsg = 'Unable to connect to server. Please check your connection and try again.';
            if (xhr.responseText) {
                try {
                    const errData = JSON.parse(xhr.responseText);
                    errorMsg = errData.message || errorMsg;
                } catch(e) {
                    errorMsg = xhr.responseText;
                }
            }
            alert(errorMsg);
        },
        complete: function() {
            // Reset button
            signInBtn.text("Sign In");
            signInBtn.css("opacity", "1");
            signInBtn.prop("disabled", false);
        }
    });
});

// 3. Social Login Placeholders
$('.social-btn').on('click', function() {
    const provider = $(this).text().trim();
    console.log('Redirecting to ' + provider + ' OAuth...');
});

