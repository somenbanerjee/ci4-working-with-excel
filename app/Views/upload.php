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
    <div class="alert alert-info" role="alert">
        Note : The excel should have 4 columns only-
        name,
        email,
        designation,
        experience

        Respectively.
    </div>
    <form class="row g-3" action="upload" method="post" enctype='multipart/form-data'>
        <div class="col-md-6">
            <label for="uploadFile" class="form-label">Excel File</label>
            <input class="form-control" type="file" name="uploadFile">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </form>

</main>

<?= $this->endSection(); ?>