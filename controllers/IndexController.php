<?php

class IndexController extends Controller
{
    public function index()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $totalProducts = $this->modelRender('Products')
            ->select()
            ->execute()
            ->numRows();
        $limitPage = ceil($totalProducts / POSTSPERPAGE);
        if ($page > $limitPage || $page < 1) {
            redirect('error');
        }
        $offset = ($page - 1) * POSTSPERPAGE;
        $products = $this->modelRender('Products')
            ->select()
            ->innerJoin('brands', 'id_brand')
            ->innerJoin('categories', 'id_category')
            ->limit(POSTSPERPAGE)
            ->offset($offset)
            ->execute()
            ->fetchAssocs();
        $_SESSION['thisPage'] = $page;
        $_SESSION['limitPage'] = $limitPage;
        $this->viewRender('layouts/navBar');
        $this->viewRender('index', $products);
    }


    public function inCard()
    {
        if (empty($_POST['id'])) {
            redirect('error');
        }
        $res = [];
        $id = $_POST['id'];
        $select = $this->modelRender('Products')
            ->select()
            ->innerJoin('brands', 'id_brand')
            ->innerJoin('categories', 'id_category')
            ->where('id', '=', $id)
            ->execute()
            ->fetchAssoc();
        if (!$select) {
            redirect('error');
        }
        $quantity = $select['quantity'];
        if ($quantity <= 0) {
            $res['error'] = 'not available';
        } else {
            if (!isset($_SESSION['card'][$id])) {
                $_SESSION['card'][$id]['quantity'] = 1;
            } elseif ($quantity > $_SESSION['card'][$id]['quantity']) {
                $_SESSION['card'][$id]['quantity'] += 1;
            }
            $res['msg'] = 'ok';
        }
        echo json_encode($res);
    }

    public function inCardQuantity()
    {
        if (!empty($_POST['id']) && !empty($_POST['quantity'])) {
            $id = $_POST['id'];
            $count = $_POST['quantity'];
            $select = $this->modelRender('Products')
                ->select()
                ->where('id', '=', $id)
                ->execute()
                ->fetchAssoc();
            if ($select) {
                $quantity = $select['quantity'];
                $price = $select['price'];
                if ($quantity >= $count && $count > 0) {
                    $_SESSION['card'][$id]['quantity'] = $count;
                    $res['quantity'] = $count;
                    $res['price'] = $price * $count . ' AMD';
                } else {
                    $res['quantity'] = $_SESSION['card'][$id]['quantity'];
                }
            } else {
                $res['error'] = 'not product';
            }
            echo json_encode($res);
        } else {
            redirect('error');
        }
    }

    public function card()
    {
        $array = [];
        if (isset($_SESSION['card'])) {
            foreach ($_SESSION['card'] as $key => $values) {
                $select = $this->modelRender('Products')
                    ->select()
                    ->innerJoin('brands', 'id_brand')
                    ->innerJoin('categories', 'id_category')
                    ->where('id', '=', $key)
                    ->execute()
                    ->fetchAssoc();
                $array[$select['id']] = $select;
            }
        }
        $this->viewRender('Card', $array);
    }

    public function deleteInCard()
    {
        $id = $_GET['id'];
        if (isset($_SESSION['card'][$id])) {
            unset ($_SESSION['card'][$id]);
        }
        redirect('index/card');
    }

    public function buyInCard()
    {
        if (isset($_POST['buyInCard'])) {
            $this->viewRender('customerInfo');
        }
    }

    public function buy()
    {
        if (isset($_POST['buy'])) {
            unset($_POST['buy']);
            if (!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['location'])) {
                $customerInfo = [
                    'name' => $_POST['name'],
                    'phone' => $_POST['phone'],
                    'location' => $_POST['location']
                ];
                $order = [
                    'customer_info' => json_encode($customerInfo),
                    'order_date' => date("Y-m-d H:i:s"),
                    'total' => 0
                ];
                foreach ($_SESSION['card'] as $productId => $item) {
                    $product = $this->modelRender('Products')
                        ->select()
                        ->where('id', '=', $productId)
                        ->execute()
                        ->fetchAssoc();
                    $order['total'] += $item['quantity'] * $product['price'];
                    $this->modelRender('Products')
                        ->update(['quantity' => $product['quantity'] - $item['quantity']])
                        ->where('id', '=', $productId)
                        ->execute();
                }
                $orderId = $this->modelRender('Orders')
                    ->insert($order)
                    ->execute()
                    ->lastInsertId;
                if ($orderId) {
                    foreach ($_SESSION['card'] as $productId => $item) {
                        $this->modelRender('Order_items')
                            ->insert([
                                'order_id' => $orderId,
                                'product_id' => $productId,
                                'quantity' => $item['quantity']
                            ])
                            ->execute();
                    }
                    unset($_SESSION['card']);
                    redirect('index');
                }
            }
        }
    }
}