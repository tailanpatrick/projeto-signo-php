<!DOCTYPE html>

<?php include('layouts/header.php'); ?>

<body>

    <div class="d-flex flex-column justify-content-center align-items-center vh-100">
        <h1 class="text-center d-block p-2"> Descubra seu signo preenchendo abaixo:</h1>
        <div class="content w-md-50 d-flex flex-column align-items-center gap-3 rounded p-5">

            <form id="signos-form" action="show_zodiac_sign.php" method="POST">
                <div class="d-flex flex-column gap-2">
                    <label for="data_nascimento" class="">Data de Nascimento:</label>
                    <input class="form-control" type="date" name="data_nascimento" id="data_nascimento" required>
                    <button class='form-control btn btn-dark btn-sm' type="submit">Enviar</button>

                </div>
            </form>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>