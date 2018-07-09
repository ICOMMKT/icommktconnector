<?php

/*
 * 2007-2015 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2015 PrestaShop SA
 *  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

/**
 * @since 1.5.0
 */
class IcommktconnectorOMSModuleFrontController extends ModuleFrontController
{

    public $php_self;

    public function __construct()
    {
        $this->php_self = 'oms';
        parent::__construct();
        $this->context = Context::getContext();
    }


    /**
     * Initialize product controller
     * @see FrontController::init()
     */
    public function init()
    {

        $module = Module::getInstanceByName('icommktconnector');
        $module->authorizeRequest();
        
        if(strpos($_SERVER['REQUEST_URI'], 'status_list')!==false){
            $module->getStatusList();
        } else {
            if($id_order = Tools::getValue('id_order')){
                $module->getSingleOrder($id_order);
            } else {
                $module->getOrders();
            }
        }
        
        /*
        $module->authorizeRequest();
        $body = $module->getApiBodyRequest();
        $operation = Tools::getValue('operation');
        
        PrestaShopLogger::addLog('WIM_VTEXREDSYS: Controller payments request: operation - '.$operation.' - request: '.$body);
        
        
        if(!$operation){
            $module->controllerPayments();
        }else{
            switch($operation){
                case 'cancellations': $module->controllerPaymentCancelation(); break;
                case 'settlements': $module->controllerPaymentSettlements(); break;
                case 'refunds': $module->controllerPaymentRefunds(); break;
            }
        }
        PrestaShopLogger::addLog('WIM_VTEXREDSYS: Controller payments request: PONG! Error?? You not must go to this line and be exited before!!');
        die('KO');
         */
    }


}
