(function () {
  function ready(fn) { document.readyState !== 'loading' ? fn() : document.addEventListener('DOMContentLoaded', fn); }
  ready(function () {
    var header = document.getElementById('gcompSocialHeader');
    if (header) {
      // Move the header dropdown into the #phone area of Chameleon header
      var phoneArea = document.getElementById('phone');
      if (phoneArea) {
        phoneArea.appendChild(header);
      }
      header.addEventListener('click', function (e) {
        e.stopPropagation();
        header.classList.toggle('open');
      });
      document.addEventListener('click', function () { header.classList.remove('open'); });
    }
    var floatBtn  = document.getElementById('gcompSocialFloatBtn');
    var floatList = document.getElementById('gcompSocialFloatList');
    var floatRoot = document.getElementById('gcompSocialFloat');
    if (floatBtn && floatList) {
      floatBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        floatList.style.display = (floatList.style.display === 'none' || !floatList.style.display) ? 'flex' : 'none';
      });
      document.addEventListener('click', function (e) {
        if (!floatList.contains(e.target) && e.target !== floatBtn) floatList.style.display = 'none';
      });
    }

    // Hide the floating button when the side cart popup is open (it overlaps the "Buy" button).
    // The Chameleon side-cart adds body class "cart-active" or makes .header-cart-backdrop visible.
    if (floatRoot) {
      function syncFloatVisibility() {
        var backdrop = document.querySelector('.header-cart-backdrop');
        var cartOpen = false;
        if (backdrop) {
          var s = window.getComputedStyle(backdrop);
          if (s.display !== 'none' && s.visibility !== 'hidden' && parseFloat(s.opacity || '1') > 0.01) {
            cartOpen = true;
          }
        }
        if (!cartOpen && document.body.classList.contains('cart-active')) cartOpen = true;
        // Any visible Bootstrap modal also covers content
        var openModal = document.querySelector('.modal.in, .modal.show');
        if (openModal && window.getComputedStyle(openModal).display !== 'none') cartOpen = true;

        floatRoot.style.display = cartOpen ? 'none' : '';
        if (cartOpen && floatList) floatList.style.display = 'none';
      }

      // Watch DOM changes that might toggle the cart popup
      var observer = new MutationObserver(function () { syncFloatVisibility(); });
      observer.observe(document.body, { attributes: true, attributeFilter: ['class', 'style'], subtree: true, childList: false });

      // Initial check + safety re-check on common triggers
      syncFloatVisibility();
      document.addEventListener('click', function () { setTimeout(syncFloatVisibility, 50); });
    }
  });
})();
