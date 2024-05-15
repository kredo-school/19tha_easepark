window.onload = function() {
    setTimeout(function() {
        var alerts = ['register', 'update', 'password', 'delete', 'restore'];
        alerts.forEach(function(alertType) {
            var alert = document.getElementById(alertType + '-success-alert');
            if (alert) {
                alert.style.opacity = '0';
                alert.addEventListener('transitionend', function(e) {
                    if (e.propertyName == 'opacity') {
                        this.style.height = '0';
                        this.style.padding = '0';
                        this.style.margin = '0';
                        this.classList.remove('mt-2');
                    }
                });
            }
        });
    }, 2000);
};