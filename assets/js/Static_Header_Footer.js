document.addEventListener("DOMContentLoaded", function () {
  const header = document.querySelector("header");
  const footer = document.querySelector("footer");

  // Definir la función toggleMenu
  function toggleMenu() {
    const dropdownMenu = document.getElementById("dropdown-menu");
    dropdownMenu.classList.toggle("show");
  }

  if (header) {
    fetch("http://localhost/kms/happybreakdevv/pages/header.php")
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.text();
      })
      .then((data) => {
        header.innerHTML = data;
        // Vuelve a agregar el event listener al botón del menú desplegable después de cargar el contenido
        document
          .getElementById("user-icon")
          .addEventListener("click", toggleMenu);
      })
      .catch((error) => console.error("Error cargando el header:", error));
  }

  if (footer) {
    fetch("http://localhost/kms/happybreakdevv/pages/footer.php")
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.text();
      })
      .then((data) => {
        footer.innerHTML = data;
      })
      .catch((error) => console.error("Error cargando el footer:", error));
  }
});
