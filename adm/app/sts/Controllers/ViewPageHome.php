<?php

namespace App\sts\Controllers;
use App\sts\Models\StsViewPageHome;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller da página visualizar coteundo do site da pagina home
 * 
 */
class ViewPageHome
{
    private array|string|null $data;

    private int|string|null $id;

  
    public function index(int|string|null $id = null): void
    {
        $viewHome =  new StsViewPageHome();
        $viewHome->viewPageHomeTop();
        $this->data['viewHomeTop'] =  $viewHome->getResultBdTop();

        $viewHome->viewPageHomeServ();
        $this->data['viewHomeServ'] = $viewHome->getResultBdServ();

        
        $viewHome->viewPageHomePrem();
        $this->data['viewHomePrem'] = $viewHome->getResultBdPrem();

        $this->data['sidebarActive'] = "view-page-home"; 

        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/home/viewPageHome", $this->data);
        $loadView->loadViewSts();
    }

  
   
}
