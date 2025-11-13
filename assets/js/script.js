/**
 * Humans Manifesto Admin Script
 *
 * Allows users to hide each manifesto entry independently in the WordPress admin dashboard.
 * Compatible with Robots Manifesto plugin for parallel display.
 */

(function () {
    function addCloseButtons() {
        var entries = document.querySelectorAll('#humans-manifesto-section .hm-entry');
        if (!entries) return;

        entries.forEach(function(entry) {
            var closeBtn = entry.querySelector('.hm-close-btn');
            if (!closeBtn) return;

            closeBtn.addEventListener('click', function() {
                entry.style.display = 'none';
            });
        });
    }

    document.addEventListener('DOMContentLoaded', addCloseButtons);
})();