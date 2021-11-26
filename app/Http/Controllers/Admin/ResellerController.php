<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\ResellerRegistrationModel;

class ResellerController extends BaseMethodAdminController {
        function __construct() {
            $this->apiModel = ResellerRegistrationModel::class;
            $this->config = (object) [
                'urlBase' => '/admin/reseller',
                'urlAction' => '/admin/reseller/save',
                'pathView'  => 'admin.pages.reseller',
                // 'pathViewInclude'  => 'admin.pages.contact.form',
                'header' => 'admin.layouts.header',
                'breadcrumbs' => [
                    [
                        'url' => '/admin',
                        'label' => 'Home',
                    ],
                    [
                        'label' => 'Gestão Site',
                    ],
                    [
                        'url' => '/admin/contentsection',
                        'label' => 'Revendedor',
                    ],
                ],
            ];
        }

        private function getListSelectBox() {
            $list = (object) [];

            // $list->contentPage = (new ContentPageModel())->get();
            // $list->contentSection = [];

            return $list;
        }

        public function list(Request $request) {
            $this->config->pathView = 'admin.components';
            $this->config->fileView = '.list';
            $this->config->title = 'Listar Informações Revendedores';
            $this->config->contentTitle = 'Lista de Informações Revendedor';
            $this->config->breadcrumbs[] = [ 'label' => 'Revendedor' ];

            $dataTableHeader = [
                [ 'title' => 'ID', 'width' => '10px','data' => 'id', ],
                [ 'title' => 'Nome', 'data' => 'name', ],
                [ 'title' => 'E-mail', 'data' => 'email', ],
                [ 'title' => 'Telefone', 'data' => 'phone', ],
                [ 'title' => 'Tipo de Comércio', 'data' => 'type_trade', ],
                [ 'title' => 'Nome do Comércio', 'data' => 'trade_name', ],
                [ 'title' => 'Mensagem', 'data' => 'message_pt', 'className' => 'cut-text',],

                // [ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
                [ 'title' => '', 'className' => 'center', 'width' => '10px','btnDel' => $this->config->urlBase ],
            ];

            return parent::list($request)
            ->with('dataTable', parent::getListEnableDisable((object) [
                'dataTableHeader' => $dataTableHeader,
                'apiModel' => $this->apiModel::query(),
            ]));
        }
}
