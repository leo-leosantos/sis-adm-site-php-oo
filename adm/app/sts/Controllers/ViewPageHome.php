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
        $viewHome->viewPageHome();

        $this->data['sidebarActive'] = "view-page-home"; 
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/home/viewPageHome", $this->data);
        $loadView->loadViewSts();
    }

  
   
}
