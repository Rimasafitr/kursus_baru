<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delete extends CI_Controller
{
    public function deleteExpiredCourses()
    {
        date_default_timezone_set("Asia/makassar");

        // Load model 'm_course' dan 'm_materi'
        $this->load->model('m_course');
        $this->load->model('m_materi');

        // Ambil kursus yang sudah melewati batas durasinya
        $currentDateTime = new DateTime();
        $expiredCourses = $this->m_course->getExpiredCourses($currentDateTime);

        // Hapus kursus dan materi yang sudah melewati batas durasinya
        foreach ($expiredCourses as $course) {
            $id_kursus = $course['id_kursus'];

            // Hapus materi berdasarkan id_kursus
            $this->m_materi->delete_materi_by_kursus($id_kursus);

            // Hapus kursus berdasarkan id_kursus
            $this->m_course->delete_course($id_kursus);
        }


        // Lakukan redirect setelah refresh
        redirect('admin');
    }
}
