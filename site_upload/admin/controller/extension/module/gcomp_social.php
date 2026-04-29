<?php
class ControllerExtensionModuleGcompSocial extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/module/gcomp_social');
        $this->load->model('extension/module/gcomp_social');
        $this->load->model('setting/setting');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('module_gcomp_social', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/module/gcomp_social', 'user_token=' . $this->session->data['user_token'], true));
        }

        $data['action'] = $this->url->link('extension/module/gcomp_social', 'user_token=' . $this->session->data['user_token'], true);
        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

        $data['add_url']    = $this->url->link('extension/module/gcomp_social/add',    'user_token=' . $this->session->data['user_token'], true);
        $data['edit_url']   = $this->url->link('extension/module/gcomp_social/edit',   'user_token=' . $this->session->data['user_token'], true);
        $data['delete_url'] = $this->url->link('extension/module/gcomp_social/delete', 'user_token=' . $this->session->data['user_token'], true);

        $data['items'] = $this->model_extension_module_gcomp_social->getList();

        $settings = $this->model_setting_setting->getSetting('module_gcomp_social');
        $data['module_gcomp_social_status'] = isset($settings['module_gcomp_social_status']) ? $settings['module_gcomp_social_status'] : 1;

        $data['user_token'] = $this->session->data['user_token'];
        $data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array('text' => $this->language->get('text_home'), 'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true));
        $data['breadcrumbs'][] = array('text' => $this->language->get('heading_title'), 'href' => $data['action']);

        $this->response->setOutput($this->load->view('extension/module/gcomp_social', $data));
    }

    public function add() {
        $this->load->language('extension/module/gcomp_social');
        $this->load->model('extension/module/gcomp_social');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            $this->model_extension_module_gcomp_social->add($this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/module/gcomp_social', 'user_token=' . $this->session->data['user_token'], true));
        }

        $this->renderForm(array());
    }

    public function edit() {
        $this->load->language('extension/module/gcomp_social');
        $this->load->model('extension/module/gcomp_social');

        $id = isset($this->request->get['id']) ? (int)$this->request->get['id'] : 0;

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            $this->model_extension_module_gcomp_social->edit($id, $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/module/gcomp_social', 'user_token=' . $this->session->data['user_token'], true));
        }

        $item = $this->model_extension_module_gcomp_social->getOne($id);
        $this->renderForm($item ? $item : array());
    }

    public function delete() {
        $this->load->language('extension/module/gcomp_social');
        $this->load->model('extension/module/gcomp_social');

        $id = isset($this->request->get['id']) ? (int)$this->request->get['id'] : 0;
        if ($id) {
            $this->model_extension_module_gcomp_social->remove($id);
            $this->session->data['success'] = $this->language->get('text_success');
        }
        $this->response->redirect($this->url->link('extension/module/gcomp_social', 'user_token=' . $this->session->data['user_token'], true));
    }

    private function renderForm($item) {
        $data = array();
        $data['form_title'] = $item ? $this->language->get('text_edit') : $this->language->get('text_add');

        $fields = array('social_id','type','label_ka','label_en','label_ru','icon','url','phone','email','color','position','sort_order','status');
        foreach ($fields as $f) {
            $data[$f] = isset($this->request->post[$f]) ? $this->request->post[$f] : (isset($item[$f]) ? $item[$f] : '');
        }
        if ($data['status'] === '') $data['status'] = 1;
        if ($data['position'] === '') $data['position'] = 'both';
        if ($data['color'] === '') $data['color'] = '#888';

        $data['action'] = $item
            ? $this->url->link('extension/module/gcomp_social/edit', 'user_token=' . $this->session->data['user_token'] . '&id=' . (int)$item['social_id'], true)
            : $this->url->link('extension/module/gcomp_social/add',  'user_token=' . $this->session->data['user_token'], true);
        $data['cancel'] = $this->url->link('extension/module/gcomp_social', 'user_token=' . $this->session->data['user_token'], true);

        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array('text' => $this->language->get('text_home'), 'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true));
        $data['breadcrumbs'][] = array('text' => $this->language->get('heading_title'), 'href' => $data['cancel']);
        $data['breadcrumbs'][] = array('text' => $data['form_title'], 'href' => $data['action']);

        $data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
        $data['user_token'] = $this->session->data['user_token'];

        $this->response->setOutput($this->load->view('extension/module/gcomp_social_form', $data));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/gcomp_social')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }

    public function install() {
        // Tables created via deploy.sql
    }

    public function uninstall() {
        // Keep data on uninstall
    }
}
