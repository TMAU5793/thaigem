<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="price-update vh-100">
        <div class="container mt-5">
            <h3 class="ff-semibold mb-3">Gold price</h3>
            <div class="table-price">
                <?= $this->include('template/gold-price') ?>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>