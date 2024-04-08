<aside class="fixed" style="background: white; width: 100%; top: 0;">
    <div class="d-flex justify-content-around">
        <div>
            <a href = "<?=DOM?>admin/dashboard" class="btn btn-success">ELectronic.am</a>
        </div>
        <div>
            <a href = "<?=DOM?>admin/dashboard/product" class="btn btn-success">Product</a>
        </div>
        <div>
            <form action="<?= DOM ?>admin/admin/logout" method="post" class="form-horizontal">
                <button type="submit" name = "logout" class="btn btn-danger btn-action mb-2">Logout</button>
            </form>
        </div>
    </div>
</aside>