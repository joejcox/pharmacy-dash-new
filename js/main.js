const deleteBtn = document.querySelectorAll(".delete-btn");
const cancelBtn = document.querySelectorAll(".cancel");
const modal = document.querySelectorAll(".modal.user-delete");

const toggleModal = (btn, index) => {
  btn.addEventListener("click", () => {
    modal[index].classList.toggle("is-active");
  });
};

deleteBtn.forEach((btn, index) => {
  toggleModal(btn, index);
});
cancelBtn.forEach((btn, index) => {
  toggleModal(btn, index);
});

$(document).ready(function () {
  const table = $("#users-table").DataTable({
    paged: true,
    iDisplayLength: 10,
    sDom: "frtip",
    fnDrawCallback: function () {
      if ($("#users-table tr").length < 11) {
        $(".dataTables_paginate").hide();
      }
    },
    columnDefs: [
      {
        targets: [3],
        searchable: false,
      },
    ],
  });

  $("#tableSearch").keyup(function () {
    table.search($(this).val()).draw();
  });
});

$(document).ready(function () {
  const table = $("#customers-table").DataTable({
    paged: true,
    iDisplayLength: 10,
    sDom: "frtip",
    fnDrawCallback: function () {
      if ($("#customers-table tr").length < 11) {
        $(".dataTables_paginate").hide();
      }
    },
  });

  $("#customerSearch").keyup(function () {
    table.search($(this).val()).draw();
  });
});
