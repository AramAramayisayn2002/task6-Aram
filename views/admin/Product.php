<div class="content-header">
    <div class="container mt-5" style="width: 70%">
        <div>
            <h1>Products</h1>
        </div>
        <div class="mb-3">
            <form action="<?= DOM ?>admin/Dashboard/add" method="post">
                <button name="add" class="btn logButton">
                    Add Product
                </button>
            </form>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Settings</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $key => $value) {
                ?>
                <tr>
                    <td>
                        <span><?= $value['id'] ?></span>
                    </td>
                    <td>
                        <span><?= mb_substr($value['name_category'], 0, 15) ?></span>
                    </td>
                    <td>
                        <span><?= mb_substr($value['name_brand'], 0, 15) ?></span>
                    </td>
                    <td>
                        <span><?= mb_substr($value['name'], 0, 80) ?></span>
                    </td>
                    <td>
                        <span><?= mb_substr($value['description'], 0, 18) . '...' ?></span>
                    </td>
                    <td>
                        <span><?= $value['quantity'] ?></span>
                    </td>
                    <td>
                        <span><?= $value['price'] ?></span>
                    </td>
                    <td style="width: 150px ;">
                        <img src="<?= "'../../../../public/uploads/products/" . $value['name_category'] . "/" . $value['image'] ?>"
                             class="tableImgProduct">
                    </td>
                    <td style="width: 40px;">
                        <div class="flex">
                            <a href="<?= DOM . 'admin/dashboard/delete?id=' . $value['id'] ?> "
                               class="btn btn-danger ms-1 me-1">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="<?= DOM . 'admin/dashboard/update?id=' . $value['id'] ?> " class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
    ?>
</div>
