<link rel="stylesheet" href="/public/assets/css/output.css">
<div class="items-center justify-center  flex ">
    <form class="flex flex-col w-1/2 !h-screen p-5 shadow-2xl border-black  rounded-lg" method="post">
        <div><?php echo '<span class="font-bold text-2xl">' . $_SESSION['firstName']  . ', Que voulez-vous publiez...</span>' ?></div>
        <textarea class="!outline-none " name="pub" id="" placeholder="A quoi pensez-vous ?" style="height: 100px;"></textarea>
        <button type="submit" class="!bg-blue-600 w-max p-2 rounded-lg text-xl text-[#fcf2f8] shadow-lg">Publier</button>
    </form>
</div>

<?php
include_once(__DIR__ . '/../../Controllers/PostController.php');
include_once(__DIR__ . '/../../Controllers/AuthController.php');


$database = new Database();
$db = $database->getConnection();
$authController = new AuthController($db);
$postController = new PostController($db);
if ($_SERVER['REQUEST_METHOD']) {
    if (isset($_POST['pub'])) {
        $postController->createPost($_POST['pub'], $_SESSION['id_account']);
    }
}
?>