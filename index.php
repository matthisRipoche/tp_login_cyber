<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Sécurisée</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h1 class="text-center mb-4">Créer un compte</h1>
                    <form id="registerForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="mail" class="form-label">Email</label>
                            <input type="email" id="mail" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" id="confirm-password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                        <div id="message" class="mt-3"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2>Liste des utilisateurs</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userTable">
                <!-- Les utilisateurs seront chargés ici par JavaScript -->
            </tbody>
        </table>
    </div>


    <script src="js/script.js"></script>
    <script src="js/users.js"></script>
</body>

</html>