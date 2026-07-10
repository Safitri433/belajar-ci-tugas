<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class PembelianController extends BaseController
{
    protected $transactionModel;
    protected $detailModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->detailModel = new TransactionDetailModel();
    }

    public function index()
    {
        $transactions = $this->transactionModel
            ->orderBy('id','ASC')
            ->findAll();

        $ids = array_column($transactions,'id');

        $products = $this->detailModel
            ->getProductsByTransactionIds($ids);

        return view('v_pembelian',[
            'transactions'=>$transactions,
            'products'=>$products
        ]);
    }

   public function updateStatus($id)
{
    $status = $this->request->getPost('status');

    $this->transactionModel->update($id, [
        'status' => $status
    ]);

    return redirect()->to('/pembelian')
                     ->with('success', 'Status berhasil diubah');
}
}