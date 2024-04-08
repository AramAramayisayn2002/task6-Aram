<div class="pt-3">
    <div class="container mt-5" style="width : 30%;">
        <div class="p-1">
            <h1 class="mb-1">Update product</h1>
            <form action="<?= DOM ?>admin/Dashboard/updateProduct" method="post" enctype="multipart/form-data"
                  class="form-horizontal">
                <div>
                    <label class="form-label">Category</label>
                    <select type="text" name="category" class="form-select" value="<?= $data[0]['name_category'] ?>"
                            required>
                        <option>Smartphones</option>
                        <option>Notebooks</option>
                        <option>Tablets</option>
                        <option>Televisions</option>
                        <option>Gaming Consoles</option>
                        <option>Digital Cameras</option>
                        <option>Drones</option>
                        <option>Cleaning Appliances</option>
                        <option>Climate Control Devices</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Brand</label>
                    <select type="text" name="brand" class="form-select" value="<?= $data[0]['name_brand'] ?>" required>
                        <option>Apple</option>
                        <option>Samsung</option>
                        <option>Sony</option>
                        <option>LG</option>
                        <option>Microsoft</option>
                        <option>Google</option>
                        <option>Dell</option>
                        <option>HP</option>
                        <option>Canon</option>
                        <option>Panasonic</option>
                    </select>
                </div>
                <div>
                    <label for="fullName" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?= $data[0]['name'] ?>"
                           placeholder="Enter name">
                </div>
                <div>
                    <label for="email" class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" value="<?= $data[0]['description'] ?>"
                           placeholder="Enter description">
                </div>
                <div>
                    <label class="form-label">price</label>
                    <input type="number" name="price" class="form-control" value="<?= $data[0]['price'] ?>">
                </div>
                <div>
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="<?= $data[0]['quantity'] ?>">
                </div>
                <div>
                    <label for="message" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div>
                    <input type="hidden" name="oldImage" class="form-control" value="<?= $data[0]['image'] ?>">
                    <input type="hidden" name="oldCategory" class="form-control"
                           value="<?= $data[0]['name_category'] ?>">
                    <input type="hidden" name="id" class="form-control" value="<?= $data[0]['id'] ?>">
                </div>
                <div class="text-center flex mt-1">
                    <a href="<?= DOM ?>admin/Dashboard/product" class="btn btn-dark me-5">Back</a>
                    <button name="updateProduct" class="btn btn-primary ms-5">Enter</button>
                </div>
            </form>
        </div>
    </div>
</div>