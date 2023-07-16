<?php
//==================================== Dashboard ====================================
if ($page == 'dashboard') {

?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <a href="<?php echo base_url("admin/courseTambah") ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mb-3"><i class="fas fa-plus"></i> Tambah Kursus</a>
                <?php echo $this->session->flashdata('pesan'); ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Kursus
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Durasi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($courses as $course) : ?>
                                    <tr>
                                        <td><?php echo $course['judul']; ?></td>
                                        <td><?php echo $course['deskripsi']; ?></td>
                                        <td><?php echo $course['durasi']; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('admin/courseView/' . $course['id_kursus']); ?>" class="btn btn-sm btn-primary">View</a>
                                            <a href="<?php echo site_url('admin/courseEdit/' . $course['id_kursus']); ?>" class="btn btn-sm btn-success">Edit</a>
                                            <a href="<?php echo site_url('admin/courseDelete/' . $course['id_kursus']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kursus ini?');">Delete</a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>



    <?php
}

//==================================== Tambah Kursus ====================================
else if ($page == 'courseTambah') {
    ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tambah Kursus</h1>

                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="<?php echo site_url('admin/courseTambah'); ?>">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul:</label>
                                    <input type="text" class="form-control" id="judul" name="judul" value="<?php echo set_value('judul'); ?>">
                                    <?php echo form_error('judul', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi:</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi"><?php echo set_value('deskripsi'); ?></textarea>
                                    <?php echo form_error('deskripsi', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="durasi" class="form-label">Durasi:</label>
                                    <input type="datetime-local" class="form-control" id="durasi" name="durasi" value="<?php echo set_value('durasi'); ?>">
                                    <?php echo form_error('durasi', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

        <?php
    }

    //==================================== Edit Kursus ====================================
    else if ($page == 'courseEdit') {
        ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Kursus</h1>


                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="<?php echo site_url('admin/courseEdit/' . $course['id_kursus']); ?>">
                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul:</label>
                                        <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $course['judul']; ?>">
                                        <?php echo form_error('judul', '<div class="text-danger">', '</div>'); ?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi:</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi"><?php echo $course['deskripsi']; ?></textarea>
                                        <?php echo form_error('deskripsi', '<div class="text-danger">', '</div>'); ?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="durasi" class="form-label">Durasi:</label>
                                        <input type="datetime-local" class="form-control" id="durasi" name="durasi" value="<?php echo $course['durasi']; ?>">
                                        <?php echo form_error('durasi', '<div class="text-danger">', '</div>'); ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>


            <?php
        }

        //==================================== View Course ====================================
        else if ($page == 'courseView') {
            ?>
                <div id="layoutSidenav_content">
                    <main>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">Detail <?php echo $course['judul']; ?></h1>
                            <?php echo $this->session->flashdata('pesan'); ?>
                            <div class="card">
                                <div class="card-header">
                                    <?php echo $course['judul']; ?>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Deskripsi:</h5>
                                    <p class="card-text"><?php echo $course['deskripsi']; ?></p>
                                    <h5 class="card-title">Durasi:</h5>
                                    <p class="card-text"><?php echo $course['durasi']; ?></p>
                                    <hr>
                                    <h2>Materi</h2>
                                    <a href="<?php echo site_url('admin/materiTambah/' . $course['id_kursus']); ?>" class="btn btn-primary mb-2">Tambah Materi Baru</a>
                                    <table id="datatablesSimple" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th style="width: 50%;">Link Embed</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($materials as $material) : ?>
                                                <tr>
                                                    <td><?php echo $material['judul']; ?></td>
                                                    <td><?php echo $material['deskripsi']; ?></td>
                                                    <td>
                                                        <a><?php echo $material['link']; ?></a>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo site_url('admin/materiEdit/' . $material['id_materi']); ?>" class="btn btn-sm btn-success">Edit</a>
                                                        <a href="<?php echo site_url('admin/deleteMateri/' . $material['id_materi']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">Delete</a>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </main>


                <?php
            }

            //==================================== Tambah Materi ====================================
            else if ($page == 'materiTambah') {
                ?>
                    <div id="layoutSidenav_content">
                        <main>
                            <div class="container-fluid px-4">
                                <h1 class="mt-4">Tambah Materi</h1>

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <form method="post" action="<?php echo site_url('admin/materiTambah/' . $course_id); ?>">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Judul:</label>
                                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Materi..." value="<?php echo set_value('judul'); ?>">
                                                <?php echo form_error('judul', '<div class="text-danger">', '</div>'); ?>
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">Deskripsi:</label>
                                                <textarea class="form-control" id="deskripsi" placeholder="Deskripsi Materi..." name="deskripsi"><?php echo set_value('deskripsi'); ?></textarea>
                                                <?php echo form_error('deskripsi', '<div class="text-danger">', '</div>'); ?>
                                            </div>


                                            <div class="mb-3">
                                                <label for="link" class="form-label">Link Embed:</label>
                                                <input type="text" class="form-control" placeholder="<iframe..." id="link" name="link" value="<?php echo set_value('link'); ?>">
                                                <?php echo form_error('link', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </main>

                    <?php
                }

                //==================================== Edit Materi ====================================
                else if ($page == 'materiEdit') {
                    ?>
                        <div id="layoutSidenav_content">
                            <main>
                                <div class="container-fluid px-4">
                                    <h1 class="mt-4">Edit Materi</h1>

                                    <div class="card">
                                        <div class="card-body">
                                            <form method="post" action="<?php echo site_url('admin/materiEdit/' . $material['id_materi']); ?>">

                                                <div class="mb-3">
                                                    <label for="judul" class="form-label">Judul:</label>
                                                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Edit Judul..." value="<?php echo $material['judul']; ?>">
                                                    <?php echo form_error('judul', '<div class="text-danger">', '</div>'); ?>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="deskripsi" class="form-label">Deskripsi:</label>
                                                    <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Edit Deskripsi..."><?php echo $material['deskripsi']; ?></textarea>
                                                    <?php echo form_error('deskripsi', '<div class="text-danger">', '</div>'); ?>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="link" class="form-label">Link Embed:</label>
                                                    <input type="text" class="form-control" id="link" name="link" placeholder="Edit Link Embed..." value="<?php echo $material['link']; ?>">
                                                    <?php echo form_error('durasi', '<div class="text-danger">', '</div>'); ?>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Edit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </main>

                        <?php
                    }


                        ?>