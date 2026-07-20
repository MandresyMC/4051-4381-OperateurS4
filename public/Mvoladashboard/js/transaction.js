(function () {
  "use strict";

  var LABELS = {
    depot: "Nouveau dépôt",
    retrait: "Nouveau retrait",
    transfert: "Nouveau transfert",
  };

  var cards = document.querySelectorAll("[data-tx-type]");
  var formPanel = document.querySelector("[data-tx-form]");
  var formEl = document.querySelector("[data-tx-form-el]");
  var typeInput = document.querySelector("[data-tx-type-input]");
  var formLabel = document.querySelector("[data-tx-form-label]");
  var destField = document.querySelector("[data-tx-dest-field]");
  var destInput = document.querySelector("[data-tx-destination]");
  var cancelBtn = document.querySelector("[data-tx-cancel]");
  var submitBtn = document.querySelector("[data-tx-submit]");
  var sourceInput = document.querySelector('input[name="numero_user_source"]');

  if (!cards.length || !formPanel) {
    return;
  }

  function selectType(type) {
    cards.forEach(function (card) {
      card.classList.toggle("is-selected", card.getAttribute("data-tx-type") === type);
    });

    typeInput.value = type;
    formLabel.textContent = LABELS[type] || "Nouvelle opération";

    if (type === "depot") {
      destField.style.display = "none";
      destInput.removeAttribute("required");
      destInput.value = sourceInput ? sourceInput.value : "";
    } else {
      destField.style.display = "";
      destInput.setAttribute("required", "required");
    }

    formPanel.classList.add("is-open");
    formPanel.scrollIntoView({ behavior: "smooth", block: "nearest" });
  }

  cards.forEach(function (card) {
    card.addEventListener("click", function () {
      selectType(card.getAttribute("data-tx-type"));
    });
  });

  if (cancelBtn) {
    cancelBtn.addEventListener("click", function () {
      formPanel.classList.remove("is-open");
      cards.forEach(function (card) {
        card.classList.remove("is-selected");
      });
      typeInput.value = "";
    });
  }

  if (formEl && submitBtn) {
    formEl.addEventListener("submit", function () {
      submitBtn.classList.add("is-loading");
      submitBtn.disabled = true;
    });
  }
})();
