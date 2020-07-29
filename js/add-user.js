const addUserBtn = document.getElementById("add-user-button");
const cancelAddUserBtn = document.getElementById("add-user-cancel");
const addUserModal = document.getElementById("add-user-modal");
const modalBackground = document.getElementById("add-user-modal-bg");

const toggleAddUserModal = (button, modal) => {
  button.addEventListener("click", (e) => {
    e.preventDefault();
    modal.classList.toggle("is-active");
  });
};

toggleAddUserModal(addUserBtn, addUserModal);
toggleAddUserModal(cancelAddUserBtn, addUserModal);
toggleAddUserModal(modalBackground, addUserModal);
