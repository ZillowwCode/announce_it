(function() {
  'use strict';

  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.announce-close').forEach(function(button) {
      button.addEventListener('click', function() {
        const announcement = this.closest('.announce-it');
        announcement.classList.add('closed');
      });
    });
  });
})();
