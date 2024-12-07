// Função para validar CPF
function validarCPF(cpf) {
  cpf = cpf.replace(/[^\d]/g, ''); // Remove caracteres não numéricos
  if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;

  let soma = 0,
    resto;
  for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
  resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) resto = 0;
  if (resto !== parseInt(cpf.substring(9, 10))) return false;

  soma = 0;
  for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
  resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) resto = 0;
  if (resto !== parseInt(cpf.substring(10, 11))) return false;

  return true;
}

// Validação no envio do formulário
document.querySelector('form').addEventListener('submit', function (e) {
  const cpf = document.getElementById('username').value;
  if (!validarCPF(cpf)) {
    e.preventDefault();
    alert('Por favor, insira um CPF válido.');
  }
});

// Teclado Virtual
document.addEventListener("DOMContentLoaded", function () {
  const input = document.getElementById("password");
  const keys = document.querySelectorAll(".keyboard button");

  keys.forEach((key) => {
    key.addEventListener("click", () => {
      const value = key.textContent.trim();
      if (value === "←") {
        input.value = input.value.slice(0, -1);
      } else if (value === "Limpar") {
        input.value = "";
      } else {
        if (input.value.length < 8) {
          input.value += value;
        }
      }
    });
  });
});
