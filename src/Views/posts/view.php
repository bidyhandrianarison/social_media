<?php
session_start();

include_once(__DIR__ . '/../../Controllers/PostController.php');
include_once(__DIR__ . '/../../Controllers/AuthController.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pub = $_POST['id_pub'];
    $sql = 'SELECT * FROM posts JOIN account ON account.id = posts.id_account WHERE id_post=?';
    $result = $conn->prepare($sql);
    $result->execute([$id_pub]);
    $data = $result->fetchAll();
    if (isset(($data))) { ?>

        <head>
            <link rel="stylesheet" href="../../../output.css">
        </head>
        <?php
        foreach ($data as $row) { ?>
            <div class=" w-full p-5 rounded-md flex items-center flex-col justify-center">
                <div class=" !bg-[#f2f8fc] w-1/2 rounded-md p-2 shadow-2xl ">
                    <div class="font-bold text-2xl"><?php echo $row['nom'] . ' ' . $row['prenom']  ?></div>
                    <div class="text-4xl !w-2/3"><?php echo $row['content'] ?></div>
                    <div class="text-xs">Publié le <?php echo $row['date_heure'] ?> </div>
                </div>
                <div class="flex gap-5">
                    <!-- COMMENTER -->
                    <form action="../../Models/Comment.php" method="post">
                        <input type="text" name="options" value="commenter" hidden>
                        <input type="text" name="id_pub" value="<?php echo $row['id_post'] ?>" hidden>
                        <button type="submit">Commenter</button>
                    </form>

                    <!-- REAGIR -->
                    <form action="../../Models/Reaction.php" method="post" class="">
                        <input type="text" name="options" value="reagir" hidden>
                        <input type="text" name="id_pub" value="<?php echo $row['id_post'] ?>" hidden>
                        <button type="submit" class="">Réagir</button>
                    </form>
                    <?php
                    // include('../../Models/Reaction.php');
                    if ($_SESSION['id_account'] == $row['id_account']) { ?>
                    <!-- SUPPRIMER -->
                        <form action="../../Controllers/PostController.php" method="post" class="">
                            <input type="text" name="options" value="supprimer" hidden>
                            <input type="text" name="id_pub" value="<?php echo $row['id_post'] ?>" hidden>
                            <button type="submit">Supprimer</button>
                        </form>
                        <!-- MODIFIER -->
                        <form action="./update.php" method="post" class="">
                            <input type="text" name="options" value="modifier" hidden>
                            <input type="text" name="pub" value="<?php echo $row['content'] ?>" hidden>
                            <input type="text" name="id_pub" value="<?php echo $row['id_post'] ?>" hidden>
                            <button type="submit">Modifier</button>
                        </form>
                    <?php }
                    ?>

                </div>
                <div>
                    <?php
                    $sql = ' SELECT * FROM posts JOIN comments ON comments.id_post=posts.id_post JOIN account ON comments.id_account=account.id  WHERE posts.id_post= ?';
                    $result = $conn->prepare($sql);
                    $result -> execute([$id_pub]);
                    $data = $result->fetchAll();
                    if (isset($data)) {
                        foreach ($data as $row) {
                    ?>
                            <div >
                                <div class="font-bold text-xs"><?php echo $row['nom'] . ' ' . $row['prenom'] ?></div>
                                <div class="font-light text-xs"><?php echo $row['coms'] ?></div>
                            </div>
                    <?php }
                    }
                    ?>
                </div>
                <a href="../layouts/index.php" class="!bg-[#f2f8fc]  w-max p-2 rounded-md shadow-2xl">Retour à l'écran principale</a>
            </div>
<?php }
    }
}
?>