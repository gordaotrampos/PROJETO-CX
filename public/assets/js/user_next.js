document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("password");
    const keys = document.querySelectorAll(".keyboard button");
  
    // Adiciona funcionalidade ao teclado virtual
    keys.forEach((key) => {
      key.addEventListener("click", () => {
        const value = key.textContent.trim();
        if (value === "←") {
          input.value = input.value.slice(0, -1); // Remove o último caractere
        } else if (value === "Limpar") {
          input.value = ""; // Limpa o campo de entrada
        } else {
          if (input.value.length < 8) {
            input.value += value; // Adiciona o caractere ao campo
          }
        }
      });
    });
  
    // Desabilita entrada pelo teclado físico
    input.addEventListener("keydown", (e) => e.preventDefault());
  });
  