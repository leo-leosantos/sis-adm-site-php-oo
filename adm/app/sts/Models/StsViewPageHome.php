<?php

namespace App\sts\Models;

use App\adms\Models\helper\AdmsRead;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}


class StsViewPageHome
{

    
   

    private array|null $resultBdTop;

    // private array|null $resultBdServ;

    private array|null $resultBdServ;
    /** @var array|null $resultBdPrem Recebe os registros do banco de dados */
    private array|null $resultBdPrem;

   

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBdTop(): array|null
    {
        return $this->resultBdTop;
    }

    function getResultBdServ(): array|null
    {
        return $this->resultBdServ;
    }

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBdPrem(): array|null
    {
        return $this->resultBdPrem;
    }


    public function viewPageHomeTop(): void
    {
        $viewHomeTop = new AdmsRead();
        $viewHomeTop->fullRead("SELECT * FROM sts_homes_tops LIMIT :limit", "limit=1");

        $this->resultBdTop = $viewHomeTop->getResult();        



    }

    public function viewPageHomeServ(): void
    {
        $viewHomeServ = new AdmsRead();

        $viewHomeServ->fullRead("SELECT id, serv_title, serv_icon_one, serv_title_one, serv_desc_one, serv_icon_two, serv_title_two, 
        serv_desc_two, serv_icon_three, serv_title_three, serv_desc_three, created, modified 
        FROM sts_homes_services LIMIT :limit", "limit=1");


        $this->resultBdServ = $viewHomeServ->getResult();  
    }
    
    
    /**
     * Metodo para visualizar os detalhes do servico premium da pagina home
     * Retorna FALSE se houver algum erro.
     * @param integer $id
     * @return void
     */
    public function viewPageHomePrem(): void
    {
        $viewHomePrem = new AdmsRead();
        $viewHomePrem->fullRead("SELECT id, prem_title, prem_subtitle, prem_desc, prem_btn_text, prem_btn_link, prem_image, created, modified FROM sts_homes_premiums LIMIT :limit", "limit=1");

        $this->resultBdPrem = $viewHomePrem->getResult();  
    }
    

}
