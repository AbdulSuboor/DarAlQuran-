<?php
class Quran_list_model extends CI_Model{

  function getAllQuranlist(){
    $t1 = 'tbl_quran';
    $t2 = 'tbl_quran_reciters';
    $t3 = 'tbl_quran_recitation_type';
    $t4 = 'tbl_quran_riways';
    $get = [
        $t1.'.*',
        $t2.'.reciter_name',
        $t3.'.recitation_type_name',
        $t4.'.riwaya_name'
    ];
    $this->db->select($get);
    $this->db->from($t1);
    $this->db->join($t2, $t1.'.reciter_id = ' . $t2.'.id', 'left');
    $this->db->join($t3, $t1.'.recitation_type_id = ' . $t3.'.id', 'left');
    $this->db->join($t4, $t1.'.riwaya_id = ' . $t4.'.id', 'left');
    return $this->db->get()->result();
  }

  function getReciters() {
    $this->db->where('status',1);
    $result = $this->db->get('tbl_quran_reciters');
    return $result->result();
  }
  function getRecitationTypes() {
    $this->db->where('status',1);
    $result = $this->db->get('tbl_quran_recitation_type');
    return $result->result();
  }
  function getRiwayas() {
    $this->db->where('status',1);
    $result = $this->db->get('tbl_quran_riways');
    return $result->result();
  }

  function insertQuranListType($reciterId,$recitationTypeId,$riwayasId,$description,$aduioUrl) {
    $this->db->set('reciter_id', $reciterId);
    $this->db->set('recitation_type_id', $recitationTypeId);
    $this->db->set('riwaya_id', $riwayasId);
    $this->db->set('description', $description);
    $this->db->set('url', $aduioUrl);
    $this->db->insert('tbl_quran');
    return true;
  }
  function updateQuranListDetails($quranTypeId,$reciterId,$recitationTypeId,$riwayasId,$description,$aduioUrl,$status) {
    $data=array('last_updated'=>date('Y-m-d H:i:s'));
    $this->db->set('reciter_id', $reciterId);
    $this->db->set('recitation_type_id', $recitationTypeId);
    $this->db->set('riwaya_id', $riwayasId);
    $this->db->set('description', $description);
    $this->db->set('url', $aduioUrl);
    $this->db->set('status', $status);
    $this->db->where('id',$quranTypeId);
    $this->db->update('tbl_quran',$data);
    return true;
  }
}
