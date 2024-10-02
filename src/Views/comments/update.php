<?php
include_once __DIR__ . '/../../../config/database.php';
include_once(__DIR__ . '/../../Controllers/CommentController.php');
include_once(__DIR__ . '/../../Controllers/AuthController.php');
$database = new Database();
$db = $database->getConnection();
$commentController = new CommentController($db);

if (isset($_POST['id_coms'])) {
    $coms = $commentController->getCommentById($_POST['id_coms'])
?>

    <head>
        <link rel="stylesheet" href="../../../output.css">
    </head>
    <div class="flex flex-col items-center justify-center ">
        <div class="p-5 shadow-2xl border-black w-1/2 rounded-lg">
            <form class="flex flex-col" method="post">
                <div><?php echo '<span class=" font-bold text-2xl">' . $_SESSION['firstName']  . ', </span>' ?></div>
                <input type="text" name="id_coms" value="<?php echo $_POST['id_coms'] ?>" hidden>
                <textarea class="!outline-none" name="coms" id="" placeholder="<?php echo $coms['content'] ?>"></textarea>
                <button type="submit" name="options" value="modifier" class="!bg-blue-600 w-max p-2 rounded-lg text-xl text-[#fcf2f8] shadow-lg">Modifier</button>
            </form>
        </div>
    </div>
<?php
}
if (isset($_POST['id_coms']) && isset($_POST['coms'])) {
    $commentController->editComs($_POST['id_coms'], $_POST['coms']);
    header('Location: /src/Views/posts/list.php');
    exit();
}
?>