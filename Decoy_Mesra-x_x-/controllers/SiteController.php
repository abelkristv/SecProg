<?php


namespace app\controllers;

use app\core\Controller;
use app\core\Application;
use app\core\Request;

class SiteController extends Controller
{
    public function home(): string
    {
        $params = [
            'name' => "TheCodeholic"
        ];
        return $this->render('home', $params);
    }

    public function contact(): string
    {
        return $this->render('contact');
    }

    public function handleContact(Request $request): string
    {
        $body = $request->getBody();
    }

    public function dashboard(): string
    {
        $this->setLayout('murid');
        return $this->render('dashboard');
    }

    
    public function mapel(): string
    {
        $this->setLayout('murid');
        return $this->render('mapel');
    }

    public function transaksi_murid(): string
    {
        $this->setLayout('murid');
        return $this->render('transaksi_murid');
    }

    public function guruPage(): string
    {
        return $this->render('guruPage');
    }

    public function transaksi(): string
    {
        return $this->render('transaksi');
    }

    public function formTransaksi(): string
    { 
        return $this->render('formTransaksi');
    }

    public function grading(): string
    { 
        return $this->render('grading');
    }

    
    public function logout(): string
    { 
        return $this->render('logout');
    }

    public function loginRedirect(): string
    {
        Application::$app->response->redirect('/login');
    }
}

?>
