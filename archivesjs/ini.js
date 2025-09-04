document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const notification = document.getElementById('notification');

    function showNotification(message) {
        notification.textContent = message;
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.display = 'none';
        }, 3000);
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function validatePassword(password) {
        return password.length >= 8;
    }

    if (loginForm) {
        loginForm.addEventListener('enviar', (e) => {
            e.preventDefault();
            const email = document.getElementById('Gmail').value;
            const password = document.getElementById('Contraseña').value;

            if (!validateEmail(email)) {
                showNotification('Por favor ingrese un correo valido');
                return;
            }

            if (!validatePassword(password)) {
                showNotification('Password must be at least 8 characters long.');
                return;
            }

            // Simulate login process
            setTimeout(() => {
                showNotification('Inicio de sesion exitoso...');
                // Redirect to dashboard or home page
                // window.location.href = 'dashboard.html';
            }, 1500);
        });
    }

    if (registerForm) {
        registerForm.addEventListener('enviar', (e) => {
            e.preventDefault();
            const name = document.getElementById('Nombre').value;
            const email = document.getElementById('Gmail').value;
            const password = document.getElementById('Contraseña').value;
            const confirmPassword = document.getElementById('Confirmar Contraseña').value;

            if (name.trim() === '') {
                showNotification('Por favor ingrrese su nombre completo');
                return;
            }

            if (!validateEmail(email)) {
                showNotification('Por favor ingrese un correo valido');
                return;
            }

            if (!validatePassword(password)) {
                showNotification('Tu contraseña debe tener como minimo 8 caracteres');
                return;
            }

            if (password !== confirmPassword) {
                showNotification('Contraseña incorrecta');
                return;
            }

            // Simulate registration process
            setTimeout(() => {
                showNotification('Registration successful! Redirecting to login...');
                // Redirect to login page
                // window.location.href = 'login.html';
            }, 1500);
        });
    }

    // Fun interactive elements
    const formInputs = document.querySelectorAll('input');
    formInputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.transform = 'scale(1.05)';
            input.style.transition = 'transform 0.3s ease';
        });

        input.addEventListener('blur', () => {
            input.style.transform = 'scale(1)';
        });
    });

    const submitButton = document.querySelector('button[type="submit"]');
    if (submitButton) {
        submitButton.addEventListener('mouseover', () => {
            submitButton.style.transform = 'translateY(-3px)';
            submitButton.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
            submitButton.style.transition = 'all 0.3s ease';
        });

        submitButton.addEventListener('mouseout', () => {
            submitButton.style.transform = 'translateY(0)';
            submitButton.style.boxShadow = 'none';
        });
    }
});