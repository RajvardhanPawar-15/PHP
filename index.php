<?php
include "./db/db.php";
$str = "hello";
echo "$str";
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
  <?php include "./components/header.php" ?>
  <main class="px-6">
    <section class="my-28">
      <div class="max-w-xl mx-auto">
        <div class="bg-gray-200 rounded-lg py-6 px-10">
          <form>
            <div class="flex flex-col gap-5">
              <div class="flex flex-col items-start gap-3">
                <label>Username: </label>
                <input
                  type="name"
                  placeholder="Enter Your Username"
                  name="email"
                  class="w-full p-2 rounded-lg outline-none" />
              </div>
              <div class="flex flex-col items-start gap-3">
                <label>Password: </label>
                <input
                  type="password"
                  placeholder="Enter Your Password"
                  name="email"
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
</body>

</html>