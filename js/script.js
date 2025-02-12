document
    .getElementById("registerForm")
    .addEventListener("submit", function (event) {
        event.preventDefault();

        let name = document.getElementById("name").value;
        console.log(name);
        let mail = document.getElementById("mail").value;
        let password = document.getElementById("password").value;
        let confirmPassword = document.getElementById("confirm-password").value;

        if (password !== confirmPassword) {
            document.getElementById("message").innerHTML =
                '<div class="alert alert-danger">Les mots de passe ne correspondent pas.</div>';
            return;
        }

        let data = {
            name: name,
            mail: mail,
            password: password,
        };

        fetch("RegisterUser.php", {
            method: "POST",
            body: JSON.stringify(data),
        })
            .then((response) => response.json())
            .then((data) => {
                document.getElementById(
                    "message"
                ).innerHTML = `<div class="alert alert-${data.status}">${data.message}</div>`;

                loadUsers();
            })
            .catch((error) => console.error("Erreur :", error));
    });

// Fonction pour charger les utilisateurs
function loadUsers() {
    fetch("GetUsers.php")
        .then((response) => response.json())
        .then((users) => {
            let userTable = document.getElementById("userTable");
            userTable.innerHTML = ""; // Vide le tableau avant de le remplir

            users.forEach((user) => {
                let row = document.createElement("tr");
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})">Supprimer</button>
                    </td>
                `;
                userTable.appendChild(row);
            });
        })
        .catch((error) =>
            console.error("Erreur lors du chargement des utilisateurs :", error)
        );
}
