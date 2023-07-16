<?php
class M_materi extends CI_Model
{
    public function create_material($data)
    {
        $this->db->insert('tb_materi', $data);
        return $this->db->insert_id();
    }

    public function get_materials_by_course($course_id)
    {
        return $this->db->get_where('tb_materi', ['id_kursus' => $course_id])->result_array();
    }

    public function get_material_by_id($material_id)
    {
        return $this->db->get_where('tb_materi', ['id_materi' => $material_id])->row_array();
    }

    public function update_material($material_id, $data)
    {
        $this->db->where('id_materi', $material_id);
        $this->db->update('tb_materi', $data);
        return $this->db->affected_rows();
    }

    public function delete_material($material_id)
    {
        $this->db->where('id_materi', $material_id);
        $this->db->delete('tb_materi');
        return $this->db->affected_rows();
    }

    public function delete_materi_by_kursus($id_kursus)
    {
        // Hapus materi yang terkait dengan id_kursus
        $this->db->where('id_kursus', $id_kursus);
        $this->db->delete('tb_materi');
    }
}
