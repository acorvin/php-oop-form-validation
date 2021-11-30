<?php

// Connect the validation form
require('validation.php');

if (isset($_POST['submit'])) {
    // validate the form submission
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>OOP PHP Form Validation</title>
</head>

<body>
    <header>
        <h1 class="text-center my-5">PHP OOP Form Validation</h1>
    </header>

    <main>
        <section style="max-width: 40em;margin: 0 auto;">
            <div class="container-sm my-5 new-user">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

                    <div class="form-group mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div>
                            <small class="text-secondary">Must be 6-18 alphanumeric characters.</small>
                        </div>
                        <!-- htmlspecialchars helps prevent sql injections -->
                        <!-- Null coalescing returns the operand if it exists and NULL otherwise -->
                        <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($_POST['username']) ?? ' ' ?>">

                        <!-- display validation error message -->
                        <div class="text-danger">
                            <?php echo $errors['username'] ?? ''; ?>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($_POST['email']) ?? ' ' ?>">

                        <!-- display validation error message -->
                        <div class="text-danger">
                            <?php echo $errors['email'] ?? ''; ?>
                        </div>
                    </div>

                    <input type="submit" value="Sign Up" name="submit" class="btn btn-primary form-control">

                </form>
            </div>
        </section>
    </main>

</body>

</html>