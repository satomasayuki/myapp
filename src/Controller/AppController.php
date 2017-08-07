<?php
namespace App\Controller;
 
use Cake\Controller\Controller;
use Cake\Event\Event;
 
class AppController extends Controller
{
 
    public function initialize()
    {
        parent::initialize();
 
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->viewBuilder()->layout('my_layout'); // 追加
 
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }
 
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}