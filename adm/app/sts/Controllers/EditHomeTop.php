<?php

namespace App\sts\Controllers;

use App\sts\Models\StsEditHomeTop;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar cor
 * @author Cesar <cesar@celke.com.br>
 */
class EditHomeTop
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;


  
    public function index(): void
    {

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ( empty($this->dataForm['SendEditHomeTop'])) {
            $viewHomeTop = new StsEditHomeTop();
            $viewHomeTop->viewHomeTop();

            if ($viewHomeTop->getResult()) {
                $this->data['form'] = $viewHomeTop->getResultBd();

                //var_dump($this->data['form']);
                $this->viewEditHomeTop();
            } else {
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editHomeTop();
        }
    }

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditHomeTop(): void
    {
        $this->data['sidebarActive'] = "view-page-home"; 
        $loadView = new \Core\ConfigView("sts/Views/home/editHomeTop", $this->data);
        $loadView->loadView();
    }

    /**
     * Editar cor.
     * Se o usuário clicou no botão, instancia a MODELS responsável em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente a cor no banco de dados.
     * Se o usuário não clicou no botão redireciona para página listar cor.
     *
     * @return void
     */
    private function editHomeTop(): void
    {
        if (!empty($this->dataForm['SendEditHomeTop'])) {
            unset($this->dataForm['SendEditHomeTop']);
            $editHomeTop = new StsEditHomeTop();
            $editHomeTop->update($this->dataForm);
            if ($editHomeTop->getResult()) {
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditHomeTop();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Conteudo do top não encontrado!</p>";
            $urlRedirect = URLADM . "view-page-home/index";
            header("Location: $urlRedirect");
        }
    }
}
