document.addEventListener('DOMContentLoaded', function() {
    function showNotification() {
        var notification = document.getElementById("notification");
        notification.style.display = 'block';
        //document.getElementById("notification").innerHtml = notification;
    }

    function hideNotification() {
        var notification = document.getElementById('notification');
        notification.style.display = 'none';
    }
});