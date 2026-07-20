(function () {
  "use strict";

  /* ---- Add a new prefix pill (simulation front, pas de sauvegarde) ---- */
  var prefixForm = document.querySelector("[data-prefix-form]");
  var prefixInput = document.querySelector("[data-prefix-input]");
  var prefixList = document.querySelector("[data-prefix-list]");

  if (prefixForm && prefixInput && prefixList) {
    prefixForm.addEventListener("submit", function (event) {
      event.preventDefault();

      var value = prefixInput.value.trim();
      if (!/^\d{3}$/.test(value)) {
        prefixInput.focus();
        return;
      }

      var exists = Array.prototype.some.call(
        prefixList.querySelectorAll(".pill__value"),
        function (el) { return el.textContent.trim() === value; }
      );
      if (exists) {
        prefixInput.value = "";
        prefixInput.focus();
        return;
      }

      var pill = document.createElement("div");
      pill.className = "pill";
      pill.innerHTML =
        '<span class="pill__value">' + value + '</span>' +
        '<button type="button" class="pill__toggle" data-state="on">DESACTIVER</button>';

      prefixList.appendChild(pill);
      window.mvolaAdminWireToggle(pill.querySelector(".pill__toggle"));

      prefixInput.value = "";
      prefixInput.focus();
    });
  }

  /* ---- Taxes & frais : le depot reste gratuit, on desactive les champs ---- */
  var typeSelect = document.querySelector("[data-taxes-type]");
  var minInput = document.querySelector("[data-taxes-min]");
  var maxInput = document.querySelector("[data-taxes-max]");
  var fraisInput = document.querySelector("[data-taxes-frais]");
  var taxesNote = document.querySelector("[data-taxes-note]");

  function toggleDepotFree() {
    if (!typeSelect) {
      return;
    }
    var selected = typeSelect.options[typeSelect.selectedIndex];
    var isDepot = selected && selected.getAttribute("data-nom") === "depot";

    [minInput, maxInput, fraisInput].forEach(function (input) {
      if (input) {
        input.disabled = isDepot;
      }
    });

    if (taxesNote) {
      taxesNote.hidden = !isDepot;
      if (isDepot) {
        taxesNote.textContent = "Le dépôt MVola est gratuit : aucun frais à configurer.";
        taxesNote.className = "taxes-form__note is-info";
      }
    }
  }

  if (typeSelect) {
    typeSelect.addEventListener("change", toggleDepotFree);
    toggleDepotFree();
  }
})();
