<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetAlert2 Test</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>SweetAlert2 Test Page</h1>
    <!-- <button onclick="showAlert()">Show Alert</button> -->

    <?php
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡La sede ha sido guardada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "sedes";
                        }
                    });
                </script>';
    ?>

</body>
</html>