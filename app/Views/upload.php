<?= $this->extend('layouts/master'); ?>

<?= $this->section('main-content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Upload</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="/" class="btn btn-sm btn-outline-secondary">
                <span data-feather="arrow-left"></span>
                Back
            </a>
        </div>
    </div>

    <?php
    if (session()->getFlashdata('error') !== NULL) {
        if (is_array(session()->getFlashdata('error'))) {
            foreach (session()->getFlashdata('error') as $error) {
    ?>
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    <li><?= esc($error) ?></li>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php }
        } ?>
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }

    if (session()->getFlashdata('success') !== NULL) {
    ?>
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    ?>

    <form class="row g-3" action="upload" method="post" enctype='multipart/form-data'>
        <div class="col-md-6">
            <label for="excelFile" class="form-label">Excel File</label>
            <input class="form-control" type="file" name="excelFile">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </form>
    <div class="alert alert-info mt-4" role="alert">
        Note : The excel file should have 4 columns only-
        name,
        email,
        designation,
        experience

        Respectively.
    </div>
</main>

<?= $this->endSection(); ?>