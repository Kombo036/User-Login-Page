// ===== script.js – behaviour for login.html =====

const form   = document.getElementById('loginForm');
const user   = document.getElementById('username');
const pw     = document.getElementById('password');
const toggle = document.getElementById('togglePw');
const btn    = document.getElementById('submitBtn');
const alert  = document.getElementById('alert');

// 1. Show / hide the password
toggle.addEventListener('click', () => {
    const hidden = pw.type === 'password';
    pw.type = hidden ? 'text' : 'password';
    toggle.textContent = hidden ? 'Hide' : 'Show';
});

// 2. Check that a box is not empty, and show its warning if it is
function check(input, hintId) {
    const ok = input.value.trim() !== '';
    input.classList.toggle('invalid', !ok);
    document.getElementById(hintId).style.display = ok ? 'none' : 'block';
    return ok;
}

user.addEventListener('input', () => check(user, 'userHint'));
pw.addEventListener('input',   () => check(pw, 'pwHint'));

// 3. Validate before sending the form to login.php
form.addEventListener('submit', (e) => {
    const okUser = check(user, 'userHint');
    const okPw   = check(pw, 'pwHint');
    if (!okUser || !okPw) {
        e.preventDefault();
        return;
    }
    btn.disabled = true;
    btn.textContent = 'Logging in...';
});

// 4. Show the error that login.php sent back (e.g. login.html?error=invalid&user=admin)
const params   = new URLSearchParams(window.location.search);
const messages = {
    invalid: 'Incorrect username or password.',
    empty:   'Please enter your username and password.',
    locked:  'Too many failed attempts. Please wait 5 minutes and try again.',
    login:   'Please log in to continue.',
    logout:  'You have been logged out.'
};

if (params.has('error') && messages[params.get('error')]) {
    alert.textContent = messages[params.get('error')];
    alert.style.display = 'block';
}
if (params.has('user')) {
    user.value = params.get('user');
    pw.focus();
}
