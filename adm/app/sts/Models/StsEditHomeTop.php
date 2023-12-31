<?php

namespace App\sts\Models;

use App\adms\Models\helper\AdmsRead;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Editar cor no banco de dados
 *
 * @author Celke
 */
class StsEditHomeTop
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * Metodo recebe como parametro o ID que será usado para verificar se tem o registro cadastrado no banco de dados
     * @param integer $id
     * @return void
     */
    public function viewHomeTop(): void
    {

        $viewHomeTop = new AdmsRead();
        $viewHomeTop->fullRead(
            "SELECT *
                    FROM sts_homes_tops
                    LIMIT :limit","limit=1"
        );

        $this->resultBd = $viewHomeTop->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Contenudo nao encontrado Home top!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo recebe como parametro a informação que será editada
     * Instancia o helper AdmsValEmptyField para validar os campos do formulário
     * Chama a função edit para enviar as informações para o banco de dados
     * @param array|null $data
     * @return void
     */
    public function update(array $data = null): void
    {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }

    /**
     * Metodo envia as informações editadas para o banco de dados
     * @return void
     */
    private function edit(): void
    {
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upHomeTop = new \App\adms\Models\helper\AdmsUpdate();
        $upHomeTop->exeUpdate("sts_homes_tops", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if ($upHomeTop->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Conteúdo do top  da pagina Home editada com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Conteúdo do top  da pagina Home não Editada!</p>";
            $this->result = false;
        }
    }


    

}



