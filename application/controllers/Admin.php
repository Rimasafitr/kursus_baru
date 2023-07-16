<?php
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_course');
        $this->load->model('m_materi');
    }

    //============= Course ============//

    public function index()
    {
        $data['courses'] = $this->m_course->get_courses();
        $data['page']    = 'dashboard';
        $data['title']    = 'Dashboard | E-Course';
        $this->tampil($data);
    }



    public function courseTambah()
    {
        $data['page'] = 'courseTambah';
        $data['title']    = 'Tambah Kursus | E-Course';
        // Validasi input form
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('durasi', 'Durasi', 'required');

        if ($this->form_validation->run() == false) {
            // Tampilkan form pembuatan kursus jika validasi gagal
            $this->tampil($data);
        } else {
            // Ambil data dari form
            $judul = $this->input->post('judul');
            $deskripsi = $this->input->post('deskripsi');
            $durasi = $this->input->post('durasi');

            // Simpan data kursus ke dalam database
            $data = array(
                'judul' => $judul,
                'deskripsi' => $deskripsi,
                'durasi' => $durasi
            );
            $this->m_course->create_course($data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            Kursus Berhasil Ditambah
        </div>');
            // Redirect ke halaman daftar kursus setelah kursus berhasil dibuat
            redirect('admin');
        }
    }

    public function courseEdit($course_id)
    {
        // Validasi input
        $data['title'] = 'Edit Kursus | E-Course';
        $data['page'] = 'courseEdit';

        // Cek apakah data kursus dengan ID yang dimaksud ada
        $data['course'] = $this->m_course->get_course_by_id($course_id);
        if (!$data['course']) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           Maaf, Durasi Course Sudah Lewat
            
        </div>');
            // Jika data kursus tidak ditemukan, redirect ke halaman admin
            redirect('admin');
        }

        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('durasi', 'Durasi', 'required');

        if ($this->form_validation->run() === false) {
            // Jika validasi form gagal, tampilkan form editing kursus lagi dengan pesan kesalahan
            $this->tampil($data);
        } else {
            $data = [
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
                'durasi' => $this->input->post('durasi')
            ];
            $this->m_course->update_course($course_id, $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            Kursus Berhasil Diedit
        </div>');
            redirect('admin');
        }
    }


    public function courseView($course_id)
    {
        $data['title']    = 'Detail Kursus | E-Course';
        $data['page']    = 'courseView';
        $data['course'] = $this->m_course->get_course_by_id($course_id);
        $data['materials'] = $this->m_materi->get_materials_by_course($course_id);
        $this->tampil($data);
    }


    public function CourseDelete($course_id)
    {
        $this->m_course->delete_course($course_id);
        redirect('admin');
    }

    //============= Materi ============//


    public function materiTambah($course_id)
    {
        $data['title'] = 'Tambah Materi | E-Course';
        $data['page'] = 'materiTambah';
        // Validasi input
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');

        // Cek apakah data kursus dengan ID yang dimaksud ada
        $course = $this->m_course->get_course_by_id($course_id);
        if (!$course) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Maaf, Durasi Course Sudah Lewat
            
         </div>');
            // Jika data kursus tidak ditemukan, redirect ke halaman admin
            redirect('admin');
        }

        if ($this->form_validation->run() === false) {
            $data['course_id'] = $course_id;
            $this->tampil($data);
        } else {
            $data = [
                'id_kursus' => $course_id,
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
                'link' => $this->input->post('link')
            ];
            $material_id = $this->m_materi->create_material($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            Materi Berhasil Ditambah
        </div>');
            redirect('admin/courseView/' . $course_id);
        }
    }

    public function materiEdit($material_id)
    {
        $data['title'] = 'Edit Materi | E-Course';
        $data['page'] = 'materiEdit';
        // Validasi input
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');


        // Cek apakah data materi dengan ID yang dimaksud ada
        $material = $this->m_materi->get_material_by_id($material_id);
        if (!$material) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Maaf, Materi Tidak Ditemukan
    </div>');
            // Jika data materi tidak ditemukan, redirect ke halaman admin
            redirect('admin');
        }


        if ($this->form_validation->run() === false) {
            $data['material'] = $this->m_materi->get_material_by_id($material_id);
            $this->tampil($data);
        } else {
            $data = [
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
                'link' => $this->input->post('link')
            ];
            $this->m_materi->update_material($material_id, $data);

            // Mendapatkan data materi setelah diperbarui
            $material = $this->m_materi->get_material_by_id($material_id);
            // Mendapatkan nilai id_kursus dari data materi
            $id_kursus = $material['id_kursus'];

            $this->session->set_flashdata('pesan', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            Materi Berhasil Diupdate
        </div>');
            redirect('admin/courseView/' . $id_kursus); // Mengarahkan ke halaman courseView dengan id_kursus yang baru
        }
    }

    public function deleteMateri($material_id)
    {
        $material = $this->m_materi->get_material_by_id($material_id);
        $this->m_materi->delete_material($material_id);
        redirect('admin/courseView/' . $material['id_kursus']);
    }

    //tools
    function tampil($data)
    {
        $this->load->view('kursus/header', $data);
        $this->load->view('kursus/sidebar', $data);
        $this->load->view('kursus/topbar', $data);
        $this->load->view('kursus/isi', $data);
        $this->load->view('kursus/footer', $data);
    }
}
