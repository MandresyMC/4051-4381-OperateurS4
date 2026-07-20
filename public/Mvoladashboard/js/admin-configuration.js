(function () {
  "use strict";

  /* ---- Formulaire prefixe : previsualise "LOCAL" / "AUTRE" selon l'operateur choisi ---- */
  var prefixOperateur = document.querySelector("[data-prefix-operateur]");
  var prefixBadge = document.querySelector("[data-prefix-badge]");

  function updatePrefixBadge() {
    if (!prefixOperateur || !prefixBadge) {
      return;
    }
    var selected = prefixOperateur.options[prefixOperateur.selectedIndex];
    var proprietaire = selected ? selected.getAttribute("data-proprietaire") : null;

    if (!proprietaire) {
      prefixBadge.hidden = true;
      return;
    }

    var isLocal = proprietaire === "local";
    prefixBadge.hidden = false;
    prefixBadge.textContent = isLocal ? "LOCAL" : "AUTRE";
    prefixBadge.className = "pill-badge " + (isLocal ? "pill-badge--local" : "pill-badge--autre");
  }

  if (prefixOperateur) {
    prefixOperateur.addEventListener("change", updatePrefixBadge);
    updatePrefixBadge();
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
