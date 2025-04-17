<?php
session_start();
include "./db/db.php";
$errmsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  $sql = "SELECT * FROM users WHERE username = :username";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    if (password_verify($password, $user["password"])) {
      $_SESSION["username"] = $user["username"];
      header("Location: ./pages/welcome.php");
      exit();
    } else {
      $errmsg = "Incorrect password";
    }
  } else {
    $errmsg = "User doesn't exist";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Homepage</title>
  <link
    href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
    rel="stylesheet" />
  <link href="./stylesheet/style.css" rel="stylesheet" />
</head>

<body>
  <?php if (!empty($errmsg)) : ?>
    <p id='errmsg' class="text-white bg-red-400 absolute top-5 right-5 p-5 rounded-lg">
      <?php echo $errmsg; ?>
    </p>
  <?php endif; ?>
  <?php include "./components/header.php" ?>
  <main class="px-6">
    <section class="my-28">
      <div class="max-w-xl mx-auto">
        <div class="bg-gray-200 rounded-lg py-6 px-10">
          <form method="POST">
            <div class="flex flex-col gap-5">
              <div class="flex flex-col items-start gap-3">
                <label>Username: </label>
                <input
                  required
                  type="text"
                  placeholder="Enter Your Username"
                  name="username"
                  class="w-full p-2 rounded-lg outline-none" />
              </div>
              <div class="flex flex-col items-start gap-3">
                <label>Password: </label>
                <input
                  required
                  type="password"
                  placeholder="Enter Your Password"
                  name="password"
                  class="w-full p-2 rounded-lg outline-none" />
              </div>
              <button
                type="submit"
                class="bg-red-400 duration-300 hover:bg-green-400 p-2 rounded-lg">
                Login
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
              <a href="./pages/signup.php">Create New Account</a>
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>
  <?php include "./components/footer.php" ?>

  <script>
    const errmsgElement = document.getElementById('errmsg');
    if (errmsgElement) {
      setTimeout(() => {
        errmsgElement.style.display = 'none';
      }, 3000);
    }
  </script>
</body>

</html>