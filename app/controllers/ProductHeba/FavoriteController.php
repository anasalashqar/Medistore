<?php
require_once __DIR__ . "/../../models/Favorite.php";

class FavoriteController
{

    private $favoriteModel;

    public function __construct($database)
    {
        $this->favoriteModel = new Favorite($database);
    }

    public function addToFavorites()
    {
        // Ensure request is POST
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            exit(json_encode(["status" => "error", "message" => "Method Not Allowed"]));
        }

        // Get product ID
        if (!isset($_POST["product_id"]) || empty($_POST["product_id"])) {
            exit(json_encode(["status" => "error", "message" => "Product ID is required"]));
        }

        $productId = $_POST["product_id"];
        $userId = "1"; // Keep user ID fixed

        if ($this->favoriteModel->addFavorite($userId, $productId)) {
            exit(json_encode(["status" => "success", "message" => "Added to favorites"]));
        } else {
            exit(json_encode(["status" => "error", "message" => "Failed to add to favorites"]));
        }
    }

    public function removeFromFavorites()
    {
        // Ensure request is POST
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            exit(json_encode(["status" => "error", "message" => "Method Not Allowed"]));
        }

        // Get product ID
        if (!isset($_POST["product_id"]) || empty($_POST["product_id"])) {
            exit(json_encode(["status" => "error", "message" => "Product ID is required"]));
        }

        $productId = $_POST["product_id"];
        $userId = "1"; // Keep user ID fixed

        if ($this->favoriteModel->removeFavorite($userId, $productId)) {
            exit(json_encode(["status" => "success", "message" => "Removed from favorites"]));
        } else {
            exit(json_encode(["status" => "error", "message" => "Failed to remove from favorites"]));
        }
    }


    // عرض المفضلات الخاصة بالمستخدم
    public function showFavorites($userId)
    {
        $favorites = $this->favoriteModel->getFavoritesByUser($userId);
        require __DIR__ . "/../../views/Favorite/favorite.php";
    }
}
