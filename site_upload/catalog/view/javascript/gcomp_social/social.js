(function () {
  function ready(fn) { document.readyState !== 'loading' ? fn() : document.addEventListener('DOMContentLoaded', fn); }
  ready(function () {
    var header = document.getElementById('gcompSocialHeader');
    if (header) {
      header.addEventListener('click', function (e) {
        e.stopPropagation();
        header.classList.toggle('open');
      });
      document.addEventListener('click', function () { header.classList.remove('open'); });
    }
    var floatBtn  = document.getElementById('gcompSocialFloatBtn');
    var floatList = document.getElementById('gcompSocialFloatList');
    if (floatBtn && floatList) {
      floatBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        floatList.style.display = (floatList.style.display === 'none' || !floatList.style.display) ? 'flex' : 'none';
      });
      document.addEventListener('click', function (e) {
        if (!floatList.contains(e.target) && e.target !== floatBtn) floatList.style.display = 'none';
      });
    }
  });
})();
