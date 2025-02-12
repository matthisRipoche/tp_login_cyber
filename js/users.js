document.addEventListener("DOMContentLoaded", function () {
    loadUsers(); // Charge la liste des utilisateurs au chargement de la page
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

function deleteUser(userId) {
    fetch("DeleteUser.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ id: userId }),
    })
        .then((response) => response.json())
        .then((data) => {
            loadUsers();
        })
        .catch((error) =>
            console.error("Erreur lors de la suppression :", error)
        );
}
