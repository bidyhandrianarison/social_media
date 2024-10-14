<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réseau Social - Accueil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/output.css">
    <link rel="stylesheet" href="/public/assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css">
    <script src="/public/assets/js/Helpers/getInitials.js" defer></script>
    <script src="/public/assets/js/jquery-3.7.1.min.js"></script>
    <script type='module' src="/public/assets/js/home.js" defer></script>
    <script type="module" src="/public/assets/js/Posts/create.js" defer></script>
    <!-- <script src="/public/assets/js/posts.js"></script> -->
     
</head>
<body class="bg-gray-100 font-sans">
    <div id="logout" class="!bg-[#091057] w-screen p-5 flex flex-row justify-between">
        <div class=""><span class="!text-white font-bold text-2xl">me</span><span class=" !text-[#091057] font-bold p-2 rounded-2xl !bg-white ">serasera</span></div>
        <div class="bg-white rounded-md flex items-center p-1">
            <div><i class="fa fa-search text-gray-400" aria-hidden="true"></i>
            </div>
            <input class="outline-none" type="text" placeholder="Rechercher...">
        </div>

        <form class="relative items-center" action="/src/Views/auth/logout.php" method="post">
            <div id="user" class=" select-none relative cursor-pointer bg-[#EC8305] h-max w-max p-2 rounded-full">
            </div>
            <button type="submit" id="logoutButton" class="bg-white hidden w-max absolute top-0 right-10 p-2 rounded-lg !text-[#091057]" name="logout">Se deconnecter</butto>
        </form>
    </div>
<div id="main">
<div class=" flex items-center justify-center">
    <form id="createPost" class="flex flex-col w-1/2 mb-4 p-5 shadow-2xl border-black  rounded-lg" >
        <div><?php echo '<span class="font-bold text-2xl">' . $_SESSION['firstName']  . ', Que voulez-vous publiez...</span>' ?></div>
        <textarea class="!outline-none " name="post" id="" placeholder="A quoi pensez-vous ?" style="height: 100px;"></textarea>
        <div>
        <input type="file" placeholder="" class="hidden" >
        <button></button>
        </div>
        <button type="submit" class="!bg-[#091057] w-max  p-2 rounded-lg font-bold text-lg text-[#fcf2f8] shadow-lg">Publier</button>
    </form>
</div>

    <div class=" w-full  ">
        <div id="allPosts" class="items-center h-full flex flex-col !gap-12">
            
        </div>
    </div>
</div>
<div id="updateForm" class="flex items-center justify-center ">

</div>
    <script>
window.userSession = <?php 
    echo json_encode(['fullName' => $_SESSION['lastName'] . ' ' . $_SESSION['firstName'],
        'email' => $_SESSION['email'], 'idAccount' => $_SESSION['id_account']]); 
?>

</script>
</body>
</html>
