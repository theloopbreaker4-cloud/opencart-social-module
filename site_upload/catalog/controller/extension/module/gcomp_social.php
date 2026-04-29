<?php
class ControllerExtensionModuleGcompSocial extends Controller {
    public function index() {
        $status = $this->config->get('module_gcomp_social_status');
        if ($status === '0' || $status === 0) return '';

        $this->load->language('extension/module/gcomp_social');

        $lang_code = isset($this->session->data['language']) ? $this->session->data['language'] : 'ge-ka';
        if (strpos($lang_code, 'en') !== false) {
            $label_field = 'label_en';
        } elseif (strpos($lang_code, 'ru') !== false) {
            $label_field = 'label_ru';
        } else {
            $label_field = 'label_ka';
        }

        $rows = $this->db->query("SELECT * FROM `" . DB_PREFIX . "gcomp_social` WHERE status = 1 ORDER BY sort_order, social_id")->rows;

        $header_items   = array();
        $floating_items = array();

        foreach ($rows as $r) {
            $href = '';
            if (!empty($r['url'])) {
                $href = $r['url'];
            } elseif (!empty($r['phone'])) {
                $href = 'tel:' . preg_replace('/[^\d+]/', '', $r['phone']);
            } elseif (!empty($r['email'])) {
                $href = 'mailto:' . $r['email'];
            }

            $item = array(
                'type'  => $r['type'],
                'label' => !empty($r[$label_field]) ? $r[$label_field] : $r['label_ka'],
                'icon'  => $r['icon'],
                'color' => $r['color'],
                'href'  => $href
            );

            if ($r['position'] === 'header' || $r['position'] === 'both') $header_items[] = $item;
            if ($r['position'] === 'floating' || $r['position'] === 'both') $floating_items[] = $item;
        }

        $data['header_items']   = $header_items;
        $data['floating_items'] = $floating_items;

        return $this->load->view('extension/module/gcomp_social', $data);
    }
}
