<?php

namespace App\sts\Controllers;

use App\sts\Models\StsEditHomeTopImg;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar imagem do perfil
 * @author Cesar <cesar@celke.com.br>
 */
class EditHomeTopImg
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Método editar imagem do Home top.
     * Receber os dados do formulário.
     * 
     * Quando o usuário clicar no botão "editar" do formulário da página editar imagem do Home top. Acessa o IF e instância o método "AdmsEditProfileImage".
     * Senão, instancia a MODELS e recupera os dados do Home top do usuário no banco de dados.
     * 
     * Existindo o usuário no banco de dados, recebe os dados do Home top e instancia o método da  home do top da home.
     * Senão redireciona o usuário para página de view home top
     * 
     * @return void
     */
    public function index(): void
    {

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['SendEditHomeTopImg'])) {
           $this->editHomeTopImg();
        } else {
            $viewHomeTopImg = new StsEditHomeTopImg();
            $viewHomeTopImg->viewHomeTopImg();
            if ($viewHomeTopImg->getResult()) {
                $this->data['form'] = $viewHomeTopImg->getResultBd();
                $this->viewEditHomeTopImg();
            } else {
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            }
        }
    }

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditHomeTopImg(): void
    {
        $loadView = new \Core\ConfigView("sts/Views/home/editHomeTopImg", $this->data);
        $loadView->loadView();
    }

    /**
     * Editar imagem do perfil.
     * Se o usuário clicou no botão, instancia a MODELS responsável em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente o perfil no banco de dados.
     * Se o usuário não clicou no botão redireciona para página de login.
     *
     * @return void
     */
    private function editHomeTopImg(): void
    {
        if (!empty($this->dataForm['SendEditHomeTopImg'])) {
            unset($this->dataForm['SendEditHomeTopImg']);

            $this->dataForm['new_image'] = $_FILES['new_image'] ? $_FILES['new_image'] : null;
            var_dump($this->dataForm);

            $editHomeTopImg = new StsEditHomeTopImg();
            $editHomeTopImg->update($this->dataForm);
            if ($editHomeTopImg->getResult()) {
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditHomeTopImg();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Image do top da pagina não encontrada!</p>";
            $urlRedirect = URLADM . "view-page-home/index";
            header("Location: $urlRedirect");
        }
    }
}
