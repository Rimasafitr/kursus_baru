<?php
class M_course extends CI_Model
{
    public function create_course($data)
    {
        $this->db->insert('tb_kursus', $data);
        return $this->db->insert_id();
    }

    public function get_courses()
    {
        return $this->db->get('tb_kursus')->result_array();
    }

    public function get_course_by_id($course_id)
    {
        return $this->db->get_where('tb_kursus', ['id_kursus' => $course_id])->row_array();
    }

    public function getExpiredCourses($currentDateTime)
    {
        $this->db->where('durasi <', $currentDateTime->format('Y-m-d H:i:s'));
        $query = $this->db->get('tb_kursus');
        return $query->result_array();
    }



    public function update_course($course_id, $data)
    {
        $this->db->where('id_kursus', $course_id);
        $this->db->update('tb_kursus', $data);
        return $this->db->affected_rows();
    }

    public function delete_course($course_id)
    {
        $this->db->where('id_kursus', $course_id);
        $this->db->delete('tb_kursus');
        return $this->db->affected_rows();
    }
}
