<?php

class DashboardController extends Controller
{
    public function __construct()
    {
        if (isset($_SESSION['admin']['id'])) {
            $id = $_SESSION['admin']['id'];
            $login = $_SESSION['admin']['login'];
            $password = $_SESSION['admin']['password'];
            $select = $this->modelRender('Admin')
                ->select()
                ->where('id', '=', $id)
                ->and()
                ->where('login', '=', $login)
                ->and()
                ->where('password', '=', $password)
                ->execute();
            if (!$select) {
                redirect('admin/admin');
            }
        } else {
            redirect('admin/admin');
        }
    }

    public function index()
    {
        $this->viewRender('admin/layouts/menuHeader');
        $this->viewRender('admin/Dashboard');
    }

    public function product()
    {
        if (isset($_SESSION['admin'])) {
            $select = $this->modelRender('Products')
                ->select()
                ->innerJoin('brands', 'id_brand')
                ->innerJoin('categories', 'id_category')
                ->execute()
                ->fetchAssocs();
            $this->viewRender('admin/layouts/menuHeader');
            $this->viewRender('admin/Product', $select);
        }
    }

    public function add()
    {
        if (isset($_POST['add'])) {
            $this->viewRender('admin/layouts/menuHeader');
            $this->viewRender('admin/Add');
        } else {
            redirect('error');
        }
    }

    public function addProduct()
    {
        if (!isset($_POST['addProduct'])) {
            redirect('error');

        }
        unset($_POST['addProduct']);
        if (!empty($_POST['category']) && !empty($_POST['brand']) && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['quantity']) && !empty($_FILES['image']['name'])) {
            $category = htmlspecialchars($_POST['category']);
            $brand = htmlspecialchars($_POST['brand']);
            $uploadImg = uploadFile($_FILES, $category);
            $id_category = $this->modelRender('Categories')
                ->select()
                ->where('name_category', '=', $category)
                ->execute()
                ->fetchAssoc();
            $id_brand = $this->modelRender('Brands')
                ->select()
                ->where('name_brand', '=', $brand)
                ->execute()
                ->fetchAssoc();
            $array = [];
            $array['id_category'] = $id_category['id_category'];
            $array['id_brand'] = $id_brand['id_brand'];
            $array['name'] = htmlspecialchars($_POST['name']);
            $array['description'] = htmlspecialchars($_POST['description']);
            $array['quantity'] = htmlspecialchars($_POST['quantity']);
            $select = $this->modelRender('Products')
                ->select()
                ->where('id_category', '=', $array['id_category'])
                ->and()
                ->where('id_brand', '=', $array['id_brand'])
                ->and()
                ->where('name', '=', $array['name'])
                ->and()
                ->where('description', '=', $array['description'])
                ->execute()
                ->fetchAssoc();
            if ($select) {
                redirect('admin/Dashboard/update?id=' . $select['id']);
                exit();
            }
            if (isset($uploadImg['name'])) {
                $array['price'] = htmlspecialchars($_POST['price']);
                $array['image'] = $uploadImg['name'];
                $insert = $this->modelRender('Products')
                    ->insert($array)
                    ->execute();
                if ($insert) {
                    redirect('admin/Dashboard/product');
                } else {
                    $_SESSION['error_msg'] = 'Failed!';
                    redirect('admin/Dashboard/add');
                }
            } else {
                $_SESSION['error_msg'] = 'Failed!';
                redirect('admin/Dashboard/add');
            }
            unset($_POST);
        } else {
            $_SESSION['error_msg'] = 'Import all fields';
            redirect('admin/Dashboard/add');
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $select = $this->modelRender('Products')
            ->select()
            ->innerJoin('brands', 'id_brand')
            ->innerJoin('categories', 'id_category')
            ->where('id', '=', $id)
            ->execute()
            ->fetchAssocs();
        $this->viewRender('admin/delete', $select);
    }

    public function deleteProduct()
    {
        $id = $_GET['id'];
        $select = $this->modelRender('Products')
            ->select()
            ->innerJoin('categories', 'id_category')
            ->where('id', '=', $id)
            ->execute()
            ->fetchAssocs();
        $delete = $this->modelRender('Products')
            ->delete()
            ->where('id', '=', $id)
            ->execute();
        if ($delete) {
            deleteFile($select[0]['image'], 'products/' . $select[0]['name_category']);
            redirect('admin/dashboard/product');
        } else {
            redirect('admin/dashboard/delete?id=' . $id);
        }
    }

    public function update()
    {
        $id = $_GET['id'];
        $select = $this->modelRender('Products')
            ->select()
            ->innerJoin('brands', 'id_brand')
            ->innerJoin('categories', 'id_category')
            ->where('id', '=', $id)
            ->execute()
            ->fetchAssocs();
        $this->viewRender('admin/update', $select);
    }

    public function updateProduct()
    {
        if (!isset($_POST['updateProduct'])) {
            redirect('error');
        }
        unset($_POST['updateProduct']);
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            if (!empty($_POST['category']) && !empty($_POST['brand']) && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['quantity']) && !empty($_POST['oldImage'])) {
                $array = [];
                $category = htmlspecialchars($_POST['category']);
                $brand = htmlspecialchars($_POST['brand']);
                if (!empty($_FILES['image']['name'])) {
                    $uploadImg = uploadFile($_FILES, $category);
                    $array['image'] = $uploadImg['name'];
                }
                $id_category = $this->modelRender('Categories')
                    ->select()
                    ->where('name_category', '=', $category)
                    ->execute()
                    ->fetchAssoc();
                $id_brand = $this->modelRender('Brands')
                    ->select()
                    ->where('name_brand', '=', $brand)
                    ->execute()
                    ->fetchAssoc();
                $array['id_category'] = $id_category['id_category'];
                $array['id_brand'] = $id_brand['id_brand'];
                $array['name'] = htmlspecialchars($_POST['name']);
                $array['description'] = htmlspecialchars($_POST['description']);
                $array['price'] = htmlspecialchars($_POST['price']);
                $array['quantity'] = htmlspecialchars($_POST['quantity']);
                $update = $this->modelRender('Products')
                    ->update($array)
                    ->where('id', '=', $id)
                    ->execute();
                if ($update) {
                    deleteFile($_POST['oldImage'], 'products/' . $_POST['oldCategory']);
                    redirect('admin/Dashboard/product');
                } else {
                    redirect('admin/Dashboard/update?id=' . $id);
                }
                unset($_POST);
            } else {
                redirect('admin/Dashboard/update?id=' . $id);
            }
        } else {
            redirect('error');
        }
    }
}
