<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("Location: ../index.php");
  exit;
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
  <?php include "../components/header.php" ?>
  <main class="px-6">
    <div class="flex justify-center items-center h-96">
      <div class="flex flex-col gap-5">
        <h2 class="font-semibold text-4xl">Hello <?php echo $_SESSION["username"]; ?></h2>
        <form method="POST" action="logout.php" class="flex justify-center">
          <button class="bg-red-400 duration-300 hover:bg-green-400 cursor-pointer px-4 py-2 text-white rounded-full w-20 h-20">Logout</button>
        </form>

      </div>
    </div>
  </main>

  <?php include "../components/footer.php" ?>
</body>

</html>