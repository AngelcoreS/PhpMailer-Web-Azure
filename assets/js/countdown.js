var countdown = 5;
var countdownElement = document.getElementById('countdown');

var countdownInterval = setInterval(function() {
    countdown--;
    countdownElement.textContent = countdown;

    if (countdown <= 0) {
        clearInterval(countdownInterval); // Stop the countdown
    }
}, 1000); // Update every second