(function () {
  "use strict";

  var destInput = document.querySelector("[data-txf-destination]");
  var form = document.querySelector("[data-txf-form]");
  var submitBtn = document.querySelector("[data-txf-submit]");

  if (destInput) {
    destInput.addEventListener("input", function () {
      var digits = destInput.value.replace(/\D/g, "").slice(0, 9);
      var groups = [digits.slice(0, 2), digits.slice(2, 4), digits.slice(4, 7), digits.slice(7, 9)];
      destInput.value = groups.filter(Boolean).join(" ");
    });
  }

  if (form && submitBtn) {
    form.addEventListener("submit", function () {
      submitBtn.classList.add("is-loading");
      submitBtn.disabled = true;
    });
  }
})();
