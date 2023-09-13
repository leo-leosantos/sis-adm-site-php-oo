<?php
if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Detalhes da Pagina Home</span>
            <div class="top-list-right">
                <!-- <?php
                echo "<a href='" . URLADM . "list-colors/index' class='btn-info'>Listar</a> ";
                if (!empty($this->data['viewColors'])) {
                    echo "<a href='" . URLADM . "edit-colors/index/" . $this->data['viewColors'][0]['id'] . "' class='btn-warning'>Editar</a> ";
                    echo "<a href='" . URLADM . "delete-colors/index/" . $this->data['viewColors'][0]['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")' class='btn-danger'>Apagar</a> ";
                }
                ?> -->
            </div>
        </div>

        <div class="content-adm-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
        </div>

        <div class="content-adm">
          
                <h1>view page home</h1>

        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->