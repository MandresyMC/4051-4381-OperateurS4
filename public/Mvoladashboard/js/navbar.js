(function () {
  "use strict";

  var toggle = document.querySelector("[data-navbar-toggle]");
  var menu = document.querySelector("[data-navbar-menu]");
  var soonBtn = document.querySelector("[data-navbar-soon]");
  var toast = document.querySelector("[data-navbar-toast]");

  if (toggle && menu) {
    toggle.addEventListener("click", function () {
      var isOpen = menu.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });
  }

  if (soonBtn && toast) {
    var toastTimer = null;
    soonBtn.addEventListener("click", function () {
      toast.textContent = "Historiques : bientot disponible !";
      toast.classList.add("visible");
      clearTimeout(toastTimer);
      toastTimer = setTimeout(function () {
        toast.classList.remove("visible");
      }, 2200);
    });
  }
})();
