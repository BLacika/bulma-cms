document.addEventListener("DOMContentLoaded", () => {
  // Get all "navbar-burger" elements
  const $navbarBurgers = Array.prototype.slice.call(
    document.querySelectorAll(".navbar-burger"),
    0
  );

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {
    // Add a click event on each of them
    $navbarBurgers.forEach((el) => {
      el.addEventListener("click", () => {
        // Get the target from the "data-target" attribute
        const target = el.dataset.target;
        const $target = document.getElementById(target);

        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        el.classList.toggle("is-active");
        $target.classList.toggle("is-active");
      });
    });
  }
});

function showMessage() {
  var message_div = document.querySelector("#message");
  setInterval(() => {
    message_div.style.display = "none";
  }, 5000);
}

function selectAll(source) {
  let checkboxes = document.querySelectorAll("#checkbox");
  checkboxes.forEach((checkbox) => {
    checkbox.checked = source.checked;
  });
}

function showFileName() {
  const fileInput = document.querySelector(
    "#post-image-upload input[type=file]"
  );
  fileInput.onchange = () => {
    if (fileInput.files.length > 0) {
      const fileName = document.querySelector("#post-image-upload .file-name");
      fileName.textContent = fileInput.files[0].name;
    }
  };
}
