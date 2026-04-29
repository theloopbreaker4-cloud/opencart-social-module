<?php
class ModelExtensionModuleGcompSocial extends Model {
    public function getList() {
        $q = $this->db->query("SELECT * FROM `" . DB_PREFIX . "gcomp_social` ORDER BY sort_order, social_id");
        return $q->rows;
    }

    public function getOne($id) {
        $q = $this->db->query("SELECT * FROM `" . DB_PREFIX . "gcomp_social` WHERE social_id = '" . (int)$id . "'");
        return $q->row;
    }

    public function add($data) {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "gcomp_social` SET
            type = '" . $this->db->escape($data['type']) . "',
            label_ka = '" . $this->db->escape($data['label_ka']) . "',
            label_en = '" . $this->db->escape($data['label_en']) . "',
            label_ru = '" . $this->db->escape($data['label_ru']) . "',
            icon = '" . $this->db->escape($data['icon']) . "',
            url = '" . $this->db->escape($data['url']) . "',
            phone = '" . $this->db->escape($data['phone']) . "',
            email = '" . $this->db->escape($data['email']) . "',
            color = '" . $this->db->escape($data['color']) . "',
            position = '" . $this->db->escape($data['position']) . "',
            sort_order = '" . (int)$data['sort_order'] . "',
            status = '" . (int)$data['status'] . "'");
        return $this->db->getLastId();
    }

    public function edit($id, $data) {
        $this->db->query("UPDATE `" . DB_PREFIX . "gcomp_social` SET
            type = '" . $this->db->escape($data['type']) . "',
            label_ka = '" . $this->db->escape($data['label_ka']) . "',
            label_en = '" . $this->db->escape($data['label_en']) . "',
            label_ru = '" . $this->db->escape($data['label_ru']) . "',
            icon = '" . $this->db->escape($data['icon']) . "',
            url = '" . $this->db->escape($data['url']) . "',
            phone = '" . $this->db->escape($data['phone']) . "',
            email = '" . $this->db->escape($data['email']) . "',
            color = '" . $this->db->escape($data['color']) . "',
            position = '" . $this->db->escape($data['position']) . "',
            sort_order = '" . (int)$data['sort_order'] . "',
            status = '" . (int)$data['status'] . "'
            WHERE social_id = '" . (int)$id . "'");
    }

    public function remove($id) {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "gcomp_social` WHERE social_id = '" . (int)$id . "'");
    }
}
