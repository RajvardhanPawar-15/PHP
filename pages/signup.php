<?php
include "../db/db.php";
$errmsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST["email"]);
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  $checksql = "SELECT * FROM users WHERE email = :email OR username = :username";
  $stmt = $conn->prepare($checksql);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':username', $username);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $errmsg = "Username or Email already exists";
  } else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $insertSql = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bindParam(':email', $email);
    $insertStmt->bindParam(':username', $username);
    $insertStmt->bindParam(':password', $hashedPassword);

    if ($insertStmt->execute()) {
      $errmsg = "User registered successfully!";
      $redirect = true;
    } else {
      $errmsg = "Something went wrong while signing up";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Signup</title>
  <link
    href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
    rel="stylesheet" />
  <link href="./stylesheet/style.css" rel="stylesheet" />
</head>

<body>
  <?php include "../components/header.php" ?>

  <?php if (!empty($errmsg)) : ?>
    <p id="errmsg" class="text-white bg-red-400 absolute top-5 right-5 p-5 rounded-lg"><?php echo $errmsg; ?></p>
  <?php endif; ?>

  <main class="px-6 relative">
    <section class="my-28">
      <div class="max-w-xl mx-auto">
        <div class="bg-gray-200 rounded-lg py-6 px-10">
          <form method="POST">
            <div class="flex flex-col gap-5">
              <div class="flex flex-col items-start gap-3">
                <label>Email: </label>
                <input
                  type="email"
                  placeholder="Enter Your Email"
                  name="email"
                  class="w-full p-2 rounded-lg outline-none"
                  required />
              </div>
              <div class="flex flex-col items-start gap-3">
                <label>Username: </label>
                <input
                  type="text"
                  placeholder="Choose a Username"
                  name="username"
                  class="w-full p-2 rounded-lg outline-none"
                  required />
              </div>
              <div class="flex flex-col items-start gap-3">
                <label>Password: </label>
                <input
                  type="password"
                  placeholder="Create a Password"
                  name="password"
                  class="w-full p-2 rounded-lg outline-none"
                  required />
              </div>
              <button
                type="submit"
                class="bg-red-400 duration-300 hover:bg-green-400 p-2 rounded-lg">
                Sign up
              </button>
            </div>
          </form>
        </div>
        <div class="mt-2 flex justify-between items-center">
          <div>
            <p class="text-sm duration-300 hover:text-red-400">
              <a href="#">Forgot Password ?</a>
            </p>
          </div>
          <div>
            <p class="text-sm duration-300 hover:text-red-400">
              <a href="../index.php">Already have an account?</a>
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include "../components/footer.php" ?>

  <script>
    const errmsgElement = document.getElementById('errmsg');
    const redirectToLogin = <?php echo isset($redirect) && $redirect ? 'true' : 'false'; ?>;

    if (errmsgElement) {
      setTimeout(() => {
        errmsgElement.style.display = 'none';
        if (redirectToLogin) {
          window.location.href = '../index.html'; // Redirect after 5 seconds
        }
      }, 3000);
    }
  </script>
</body>

</html>