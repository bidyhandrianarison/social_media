<?php
session_start();
include '../../../config/database.php';

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../../output.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>

    <div class="!bg-blue-600 w-screen p-5 flex flex-row justify-between">
        <div class="">m<span class="!text-white font-bold text-2xl">e</span>-<span class="!bg-green-500 p-2 !rounded-lg !text-white font-bold">serasera</span></div>
        <form action="../../Helpers/logout.php" method="post">
            <button type="submit" class=" !bg-red-400 p-2 rounded-lg text-[#f2f8fc]" name="logout">Se deconnecter</button>
        </form>
    </div>
    <?php if (isset($_SESSION['email'])) {
        echo '<h1 class="font-bold text-4xl text-center">Bonjour mon ami ' . $_SESSION['lastName'] . ' ' . $_SESSION['firstName'] . '!</h1>';
    ?>
        <div>
            <?php include('../posts/create.php') ?>
            <!-- <form action="../posts/create.php" method="post" >
        <button type="submit" class="!bg-blue-600  p-2 rounded-lg text-2xl text-[#f2f8fc] shadow-lg" >Créez une nouvelle publication</button>  
        </form>  -->

        </div>
        <?php
        $sql = 'SELECT * FROM posts JOIN account ON account.id = posts.id_account ORDER BY posts.id_post DESC';
        $result = $conn->query($sql);
        $data = $result->fetchAll();
        if (isset($data)) { ?>
            <div class="flex flex-col w-full !my-6 gap-2 ">
                <?php foreach ($data as $row) { ?>
                    <div class="flex flex-col shadow-2xl border-black p-5 w-1/2  rounded-lg !bg-[#f2f8fc] ">
                        <p class="font-bold"> <?php echo $row['nom'] . ' ' . $row['prenom'] ?> </p>
                        <div class="h-50 overflow-y-hidden">
                            <p class="!font-light  w-full "> <?php echo $row['content'] ?> </p>
                        </div>

                        <div>
                            <form action="../posts/view.php" method="post">
                                <input name="id_pub" type="text" hidden value='<?php echo $row['id_post'] ?>'>
                                <button type="submit" class="!bg-blue-400 p-2 text-xs rounded-lg">Voir la publication</button>
                            </form>
                        </div>
                    </div>
            </div>
        <?php } ?>
        </div>


</body>

</html>
<?php } else {
            header('Location: ../auth/login.php');
            exit();
        }
    }
?>