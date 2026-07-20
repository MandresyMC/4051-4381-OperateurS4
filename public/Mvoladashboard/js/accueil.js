(function () {
  "use strict";

  var toggleBtn = document.querySelector("[data-solde-toggle]");
  var label = document.querySelector("[data-solde-label]");

  if (!toggleBtn || !label) {
    return;
  }

  var solde = parseFloat(toggleBtn.getAttribute("data-solde")) || 0;
  var formatted = solde.toLocaleString("fr-FR", { maximumFractionDigits: 2 }) + " Ar";
  var revealed = false;

  toggleBtn.addEventListener("click", function () {
    revealed = !revealed;
    toggleBtn.classList.toggle("is-revealed", revealed);
    label.style.opacity = "0";
    setTimeout(function () {
      label.textContent = revealed ? formatted : "VOIR MON SOLDE";
      label.style.opacity = "1";
    }, 150);
  });

  label.style.transition = "opacity 0.15s ease";
})();
