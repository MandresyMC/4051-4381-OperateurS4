(function () {
  "use strict";

  var VALID_PREFIXES = ["32", "33", "34", "37", "38"];

  var form = document.querySelector("[data-mvola-form]");
  var input = document.querySelector("[data-mvola-phone]");
  var group = document.querySelector("[data-mvola-group]");
  var hint = document.querySelector("[data-mvola-hint]");
  var button = document.querySelector("[data-mvola-submit]");
  var faceId = document.querySelector("[data-mvola-faceid]");
  var toast = document.querySelector("[data-mvola-toast]");

  if (!form || !input) {
    return;
  }

  function digitsOnly(value) {
    return value.replace(/\D/g, "").slice(0, 9);
  }

  function formatDigits(digits) {
    var groups = [digits.slice(0, 2), digits.slice(2, 4), digits.slice(4, 7), digits.slice(7, 9)];
    return groups.filter(Boolean).join(" ");
  }

  function validate(digits) {
    if (digits.length === 0) {
      return { valid: false, message: "" };
    }
    if (digits.length < 9) {
      return { valid: false, message: "Le numero doit contenir 9 chiffres." };
    }
    var prefix = digits.slice(0, 2);
    if (VALID_PREFIXES.indexOf(prefix) === -1) {
      return { valid: false, message: "Le numero doit commencer par 32, 33, 34, 37 ou 38." };
    }
    return { valid: true, message: "" };
  }

  function refreshState() {
    var digits = digitsOnly(input.value);
    var result = validate(digits);

    if (digits.length === 0) {
      group.classList.remove("is-invalid");
      hint.classList.remove("visible");
    } else if (!result.valid) {
      group.classList.add("is-invalid");
      hint.textContent = result.message;
      hint.classList.add("visible");
    } else {
      group.classList.remove("is-invalid");
      hint.classList.remove("visible");
    }

    button.disabled = !result.valid;
    return result.valid;
  }

  input.addEventListener("input", function () {
    var digits = digitsOnly(input.value);
    var formatted = formatDigits(digits);
    input.value = formatted;
    refreshState();
  });

  input.addEventListener("focus", function () {
    group.classList.add("is-focused");
  });

  input.addEventListener("blur", function () {
    group.classList.remove("is-focused");
  });

  form.addEventListener("submit", function (event) {
    var valid = refreshState();
    if (!valid) {
      event.preventDefault();
      group.classList.add("is-invalid");
      input.focus();
      return;
    }
    button.classList.add("is-loading");
    button.disabled = true;
  });

  if (faceId && toast) {
    var toastTimer = null;
    faceId.addEventListener("click", function () {
      faceId.classList.remove("is-scanning");
      void faceId.offsetWidth;
      faceId.classList.add("is-scanning");

      toast.textContent = "L'authentification biometrique arrive bientot !";
      toast.classList.add("visible");
      clearTimeout(toastTimer);
      toastTimer = setTimeout(function () {
        toast.classList.remove("visible");
      }, 2400);
    });
  }

  refreshState();

  var alertEl = document.querySelector("[data-mvola-alert]");
  if (alertEl) {
    alertEl.classList.add("shake");
  }
})();
