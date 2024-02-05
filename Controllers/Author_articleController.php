<?php

require_once '../../Models/Users.php';
require_once '../../Models/Article.php';
require_once '../../Controllers/DBController.php';


class Author_articleController
{

    public $db;
    public function lastRow()
    {
        $this->db = new DBController;
        if ($this->db->openConnection()) {
            $query = "SELECT ArticleID FROM articles ORDER BY ArticleID DESC LIMIT 1"; 
            $result = $this->db->select($query);
            if (!empty($result)) {
                return $result[0]['ArticleID'];
            } else {
                return false;
            }
        } else {
            echo "Error in Database Connection";
            return false; 
        }
    }
    
    public function insert($username,$lastArticleID)
    {
        
        if ($lastArticleID !== false) {
            $this->db = new DBController;
            if ($this->db->openConnection()) {
                $query = "INSERT INTO `author_article` (`ArticleID`, `AuthorName`) VALUES ('$lastArticleID', '$username')";
                $result = $this->db->insert($query);
                if ($result !== false) {
                    // $_SESSION["userId"] = $result;
                    // $_SESSION["username"] = $username;
                    return true;
                } else {
                    $_SESSION["errMsg"] = "Something went wrong... try again later";
                    return false;
                }
            } else {
                echo "Error in Database Connection";
                return false;
            }
        } else {
            $_SESSION["errMsg"] = "No articles found";
            return false;
        }
    }
   
   


    public function getArticle(Users $user)
    {
        $username = $user->getUsername(); // use the getter method for the username property
        $this->db = new DBController;
        if ($this->db->openConnection()) {
            $query = "SELECT Users.username, articles.*
                      FROM Users
                      JOIN author_article ON Users.username = author_article.AuthorName
                      JOIN articles ON author_article.ArticleID = articles.articleID
                      WHERE author_article.AuthorName = '$username'
                      ORDER BY Users.username ;";
            return $this->db->select($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }
    




}

?>