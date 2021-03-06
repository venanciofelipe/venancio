<?php
require_once './vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/', function(){
    
    $sql = new Blog\DB\Sql();
    $resultados = $sql->select("SELECT * FROM noticias");
    echo json_encode($resultados);

});
$app->get("/categorias", function(){
    $categorias = new Blog\model\Categoria();
    //$resultados = $categorias->getAllCat();
    $resultados = $categorias->getAllCat();
    echo json_encode($resultados);
});
$app->get("/categoria/:nome", function($nome){
    $categorias = new Blog\model\Categoria();
    //$resultados = $categorias->getAllCat();
    $resultados = $categorias->getCatByName($nome);
    echo json_encode($resultados);
});
$app->get("/add_categoria", function(){
    $categorias = new Blog\model\Categoria();
    $dados = array(
        "cat_titulo"=>"Jogos",
        "cat_name"=>"jogos",
        "cat_parent"=>1
    );
    $resultados = $categorias->insertCat($dados);
    echo $resultados;
});
$app->get("/del_categoria", function(){
    $categorias = new Blog\model\Categoria();
    if($categorias->deleteCatById(3)){
        echo "Categoria removida com sucesso!";
    }else{
        echo "Erro ao remover a categoria";
    }
});
$app->run();