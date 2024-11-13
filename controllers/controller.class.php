<?php

class Controller
{
    private PDO $pdo;
    private \Twig\Loader\FilesystemLoader $loader;
    private \Twig\Environment $twig;
    private ?array $get = null;
    private ?array $post = null;

    public function __construct(\Twig\Loader\FilesystemLoader $loader, \Twig\Environment $twig)
    {
        $db = Bd::getInstance();
        $this->pdo = $db->getConnection();

        $this->loader = $loader;
        $this->twig = $twig;

        if (isset($_GET) && !empty($_GET))
        {
            $this->get = $_GET;
        }

        if (isset($_POST) && !empty($_POST))
        {
            $this->post = $_POST;
        }
    }

    // Appelle une méthode d'un controller
    public function call(string $methode): mixed
    {

        //test si la methode existe
        if (!method_exists($this, $methode))
        {
            throw new Exception("La methode $methode n'existe pas dans la controleur __CLASS__");
        }

        return $this->$methode();
    }

    public function getPdo(): ?PDO
    {
        return $this->pdo;
    }

    public function setPdo(?PDO $pdo): void
    {
        $this->pdo = $pdo;
    }

    public function getLoader(): \Twig\Loader\FilesystemLoader
    {
        return $this->loader;
    }

    public function setLoader(\Twig\Loader\FilesystemLoader $loader): void
    {
        $this->loader = $loader;
    }

    public function getTwig(): \Twig\Environment
    {
        return $this->twig;
    }

    public function setTwig(\Twig\Environment $twig): void
    {
        $this->twig = $twig;
    }

    public function getGet(): array
    {
        return $this->get;
    }

    public function setGet(array $get): void
    {
        $this->get = $get;
    }

    public function getPost(): array
    {
        return $this->post;
    }

    public function setPost(array $post): void
    {
        $this->post = $post;
    }
}
