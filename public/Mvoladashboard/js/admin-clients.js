(function () {
  "use strict";

  var searchInput = document.querySelector("[data-clients-search]");
  var soldeBtn = document.querySelector("[data-clients-solde-filter]");
  var soldeLabel = document.querySelector("[data-clients-solde-label]");
  var opsBtn = document.querySelector("[data-clients-ops-filter]");
  var opsLabel = document.querySelector("[data-clients-ops-label]");
  var body = document.querySelector("[data-clients-body]");
  var emptyState = document.querySelector("[data-clients-empty]");

  if (!body) {
    return;
  }

  var state = {
    search: "",
    soldeSort: null,
    opsSort: null,
  };

  function getRows() {
    return Array.prototype.slice.call(body.querySelectorAll("[data-clients-row]"));
  }

  function applyFilters() {
    var rows = getRows();
    var visibleCount = 0;

    rows.forEach(function (row) {
      var visible = row.getAttribute("data-search").indexOf(state.search) !== -1;
      row.hidden = !visible;
      if (visible) {
        visibleCount += 1;
      }
    });

    if (emptyState) {
      emptyState.hidden = visibleCount !== 0;
    }
  }

  function sortBy(attribute, direction) {
    var rows = getRows();
    rows.sort(function (a, b) {
      var valueA = parseFloat(a.getAttribute(attribute));
      var valueB = parseFloat(b.getAttribute(attribute));
      return direction === "asc" ? valueA - valueB : valueB - valueA;
    });
    rows.forEach(function (row) {
      body.appendChild(row);
    });
  }

  if (searchInput) {
    searchInput.addEventListener("input", function () {
      state.search = searchInput.value.trim().toLowerCase();
      applyFilters();
    });
  }

  if (soldeBtn && soldeLabel) {
    soldeBtn.addEventListener("click", function () {
      state.soldeSort = state.soldeSort === "desc" ? "asc" : "desc";
      soldeLabel.textContent = state.soldeSort === "desc" ? "Solde : plus élevé" : "Solde : plus faible";
      soldeBtn.classList.add("is-active");
      if (opsBtn) {
        opsBtn.classList.remove("is-active");
      }
      sortBy("data-solde", state.soldeSort);
    });
  }

  if (opsBtn && opsLabel) {
    opsBtn.addEventListener("click", function () {
      state.opsSort = state.opsSort === "desc" ? "asc" : "desc";
      opsLabel.textContent = state.opsSort === "desc" ? "Activité : plus actifs" : "Activité : moins actifs";
      opsBtn.classList.add("is-active");
      if (soldeBtn) {
        soldeBtn.classList.remove("is-active");
      }
      sortBy("data-ops", state.opsSort);
    });
  }
})();
