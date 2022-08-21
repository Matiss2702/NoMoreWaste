<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">

        <div class="col-md-3">
            <div class="card product-wap" style="border-radius: 1rem;">
                <div class="card" style="padding: 0.4rem;border-radius: 1rem;">
                    <div class="card-img-overlay product-overlay d-flex align-items-center justify-content-center" style="border-radius: 1rem;/* padding:  1rem; */">
                        <ul class="list-unstyled">
                            <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="fa-solid fa-cart-shopping"></i></a></li>
                        </ul>
                    </div>
                </div>
 
            </div>
        </div>
</div>
<?= $this->endSection() ?>
