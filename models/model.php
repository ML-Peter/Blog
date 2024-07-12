<?php
// model.php

// Fonction de connexion à la base de données
function getDbConnection(){
    try {
        $dsn = "mysql:host=localhost;dbname=blog";
        $username = "root";
        $password = "root";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $conn = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
    return $conn;
}
function getArticles()
{
    $conn = getDbConnection();
    $page = 1;
    $articlesParPage = 3;

    if ($page < 1) {
        $page = 1;
    }
    $offset = ($page - 1) * $articlesParPage; // Calcul de l'offset

    // Récupération d'articles
    $sql = "SELECT a.titre, a.contenu, a.img_couverture, a.date_publication, u.fullname
            FROM article a
            INNER JOIN user u ON a.user_id = u.id
            ORDER BY a.date_publication DESC
            LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':limit', $articlesParPage, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $articles = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $articles[] = $row;
    }

    return $articles;
}
function getPagination(){
    $articlesParPage = 3;
    $conn = getDbConnection();
    // Requête pour le nombre total d'articles
    $totalArticlesQuery = "SELECT COUNT(*) as total FROM article";
    $stmt = $conn->prepare($totalArticlesQuery);
    $stmt->execute();
    $totalArticles = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalArticles / $articlesParPage); // Nombre total de pages

    return $totalPages;
}

function getUserArticles($id)
{
    $conn = getDbConnection();
    $userId = $id;

    $sql = "SELECT titre, contenu, img_couverture, date_publication, id 
        FROM article 
        WHERE user_id = :userId 
        ORDER BY date_publication DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $articles = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $articles[] = $row;
    }
    return $articles;
}

function editImg($uploaded_file, $id){
    $conn = getDbConnection();
    $sql = "UPDATE article SET img_couverture = :img WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['img' => $uploaded_file, 'id' => $id]);
}

function deleteArticle($article_id){
    $conn = getDbConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("DELETE FROM article WHERE id = :article_id");
    $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
    $stmt->execute();
}

function preModifierArticle($id){
    $GLOBALS['user_id'] = $id;
    $conn = getDbConnection();
    $sql = "SELECT * FROM article WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    return $article;
}
function modifierArticle($id, $titre, $contenu){
    $conn = getDbConnection();
    $sql = "UPDATE article SET 
    titre = :titre, contenu = :contenu WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->execute(['titre' => $titre, 'contenu' => $contenu, 'id' => $id]);
}
function logAdmin(){
    // Connexion a la base des donnees
    $conn = getDbConnection();
    $stmt = $conn->prepare('SELECT id, user, password, fullname FROM user WHERE user = :user');
    $stmt->execute([':user' => $GLOBALS['username']]);
    $user = $stmt->fetch();
    return $user;
}
function createAccount(){
    // Connexion a la base des donnees
    $conn = getDbConnection();
    //$hashedPassword = password_hash($GLOBALS['password'], PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO user (fullname, user, password) VALUES (:fullname, :user, :password)");
    $stmt->execute(['fullname' => $GLOBALS['fullname'], 'user' => $GLOBALS['login'], 'password' => $GLOBALS['password']]);
}
function postedArticles(){
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO article (titre, contenu, img_couverture, date_publication, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_SESSION['titre'], $_SESSION['contenu'], $GLOBALS['uploaded_file'], $_SESSION['date'], $GLOBALS['user_id']]);
}
function verificationExistLoginOrFullname(){
    // Connexion a la base des donnees
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM user WHERE fullname = :fullname OR user = :user");
    $stmt->execute([':fullname' => $GLOBALS['fullname'], ':user' => $GLOBALS['login']]);
    $result = $stmt->fetch();
    return $result;
}