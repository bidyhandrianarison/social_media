<?php
include_once(__DIR__ . '/../../Controllers/PostController.php');
include_once(__DIR__ . '/../../Controllers/AuthController.php');

include(__DIR__ . '/../layouts/header.php');
include(__DIR__ . '/create.php');
$database = new Database();
$db = $database->getConnection();
$authController = new AuthController($db);
$postController = new PostController($db);
$posts = $postController->getAllPosts();
$account= new Account($db);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../output.css">
</head>

<body>
    <div class="flex flex-col justify-center items-center">
        <?php if (isset($posts)) {
            foreach ($posts as $post) { ?>
                <div class="flex flex-col shadow-2xl border-black p-5 w-1/2  rounded-lg !bg-[#f2f8fc] ">
                    <div class="flex gap-4 h-max items-center">
                        <div class=" !w-20 !h-20 p-2 font-bold !text-white !bg-blue-400"><div><?php echo $account->getInitials($post['nom'], $post['prenom']) ?></div></div>
                        <p class="font-bold"> <?php echo $post['nom'] . ' ' . $post['prenom'] ?> </p>
                    </div>
                    <div class="h-50 overflow-y-hidden">
                        <p class="!font-light  w-full "> <?php echo $post['content'] ?> </p>
                    </div>
                    <div>
                        <form action="../posts/viewPost.php" method="post">
                            <input name="id_pub" type="text" hidden value='<?php echo $post['id_post'] ?>'>
                            <button type="submit" class="!bg-blue-400 text-[#fcf2f8] p-2 text-xs rounded-lg">Voir la publication</button>
                        </form>
                    </div>
                </div>
        <?php    }
        }

        ?>

    </div>

</body>

</html>