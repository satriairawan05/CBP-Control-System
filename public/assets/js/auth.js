$(document).ready(function() {
    $('#togglePassword i').click(function(event) {
        event.preventDefault();
        const passwordInput = $('#password');
        const togglePassword = $('#togglePassword i');

        if (passwordInput.attr('type') === 'text') {
            passwordInput.attr('type', 'password');
            togglePassword.removeClass('bx-lock-open').addClass('bx-lock');
        } else if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            togglePassword.removeClass('bx-lock').addClass('bx-lock-open');
        }
    });

    $('#togglePasswordConfirm i').click(function(event) {
        event.preventDefault();
        const passwordInput = $('#passwordConfirm');
        const togglePassword = $('#togglePasswordConfirm i');

        if (passwordInput.attr('type') === 'text') {
            passwordInput.attr('type', 'password');
            togglePassword.removeClass('bx-lock-open').addClass('bx-lock');
        } else if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            togglePassword.removeClass('bx-lock').addClass('bx-lock-open');
        }
    });
});
