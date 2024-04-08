<div class="content-header">
    <div class="container mt-5" style="width: 40%">
        <div class="card">
            <div class="card-body">
                <div class="justify-content-center text-center">
                    <h1 class=" mb-2"><?= ($data[0]['name_brand']); ?></h1>
                    <h3 class=" mb-2"><?= ($data[0]['name']); ?></h3>
                    <p class=" mb-1"><?= ($data[0]['price']); ?> AMD / <?= ($data[0]['quantity']); ?> pieces</p>
                    <p class=" mb-1"><?= ($data[0]['description']); ?></p>
                </div>
                <div class="justify-content-center text-center">
                    <img src="'../../../../public/uploads/products/<?= $data[0]['name_category'] . "/" . $data[0]['image'] ?>"
                         id="deleteImgProduct">
                </div>
                <div class="justify-content-center text-center mt-3">
                    <a href="<?= DOM ?>admin/dashboard/product" class="btn btn-dark">Back</a>
                    <a href="<?= DOM . 'admin/dashboard/deleteProduct?id=' . $data[0]['id'] ?> "
                       class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
