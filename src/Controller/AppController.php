<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [ // Componente para la autorización de usarios
                'authorized' => ['Controller'],
                'authenticate' => [
                    'Form' => [
                        'fields' => [ // Se autentifica con los campos email y password.
                            'username' => 'email',
                            'password' => 'password'
                        ],
                        'finder' => 'auth'
                    ],
                    'ADmad/HybridAuth.HybridAuth' => [
                        // All keys shown below are defaults
                        'fields' => [
                            'provider' => 'provider',
                            'openid_identifier' => 'openid_identifier',
                            'email' => 'email'
                        ],
                        'profileModel' => 'ADmad/HybridAuth.SocialProfiles',
                        'profileModelFkField' => 'user_id',
                        'userModel' => 'Users',
                        'hauth_return_to' => null
                    ],
                ],
                'loginAction' => [ //action para logearse
                    'controller' => 'Users',
                    'action' => 'login','plugin' => false
                ],
                //'authError' => $this->Flash->error('Ingrese sus datos.', ['key' => 'auth']),
                'loginRedirect' => [ //Redireccionamiento después de logearse
                    'controller' => 'Pages', 
                    'action' => 'display', 'home' , 'plugin' => false
                ],
                'logoutRedirect' => [ //Redireccionamiento después de cerrar sesión.
                    'controller' => 'Pages', 
                    'action' => 'display', 'home' 
                ],
                'unauthorizedRedirect' => $this->referer()
            ]);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
        
        
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    
    public function beforeFilter(Event $event){
        
        $this->Auth->config('authorize', ['Controller']);
        $this->set('current_user', $this->Auth->user() );
    }
    
    public function isAuthorized($user){
        if(isset($user['role']) and $user['role'] === 'admin'){
            return true;
        }
        return false;
    }
    
    
    
    
    
    
    
    
    
}
