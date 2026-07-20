(function () {
  "use strict";

  var searchInput = document.querySelector("[data-hist-search]");
  var dateBtn = document.querySelector("[data-hist-date-filter]");
  var dateLabel = document.querySelector("[data-hist-date-label]");
  var statusBtn = document.querySelector("[data-hist-status-filter]");
  var statusLabel = document.querySelector("[data-hist-status-label]");
  var body = document.querySelector("[data-hist-body]");
  var emptyState = document.querySelector("[data-hist-empty]");

  if (!body) {
    return;
  }

  var STATUS_CYCLE = ["tous", "valide", "echec"];
  var STATUS_LABELS = {
    tous: "Filtrer par statut",
    valide: "Statut : Validé",
    echec: "Statut : Échec",
  };

  var state = {
    search: "",
    status: "tous",
    dateSort: "desc",
  };

  function getRows() {
    return Array.prototype.slice.call(body.querySelectorAll("[data-hist-row]"));
  }

  function applyFilters() {
    var rows = getRows();
    var visibleCount = 0;

    rows.forEach(function (row) {
      var matchesSearch = row.getAttribute("data-search").indexOf(state.search) !== -1;
      var rowStatus = row.getAttribute("data-statut");
      var matchesStatus = state.status === "tous" || rowStatus === state.status;
      var visible = matchesSearch && matchesStatus;

      row.hidden = !visible;
      if (visible) {
        visibleCount += 1;
      }
    });

    if (emptyState) {
      emptyState.hidden = visibleCount !== 0;
    }
  }

  function sortByDate() {
    var rows = getRows();
    rows.sort(function (a, b) {
      var dateA = a.getAttribute("data-date");
      var dateB = b.getAttribute("data-date");
      if (dateA === dateB) {
        return 0;
      }
      var comparison = dateA > dateB ? 1 : -1;
      return state.dateSort === "asc" ? comparison : -comparison;
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

  if (dateBtn && dateLabel) {
    dateBtn.addEventListener("click", function () {
      state.dateSort = state.dateSort === "desc" ? "asc" : "desc";
      dateBtn.classList.add("is-active");
      dateLabel.textContent = state.dateSort === "desc"
        ? "Date : plus récent"
        : "Date : plus ancien";
      sortByDate();
    });
  }

  if (statusBtn && statusLabel) {
    statusBtn.addEventListener("click", function () {
      var currentIndex = STATUS_CYCLE.indexOf(state.status);
      var nextIndex = (currentIndex + 1) % STATUS_CYCLE.length;
      state.status = STATUS_CYCLE[nextIndex];
      statusLabel.textContent = STATUS_LABELS[state.status];
      statusBtn.classList.toggle("is-active", state.status !== "tous");
      applyFilters();
    });
  }

  sortByDate();
})();
