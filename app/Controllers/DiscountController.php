<?php

namespace App\Controllers;

use App\Models\DiscountModel;

class DiscountController extends BaseController
{
    protected $discountModel;

    public function __construct()
{
    helper(['form', 'url', 'number']);

    $this->discountModel = new DiscountModel();
}

    public function index()
    {
        $data['discounts'] = $this->discountModel->findAll();

        return view('v_discount', $data);
    }
    public function store()
{
    $rules = [
        'tanggal' => 'required|is_unique[discount.tanggal]',
        'nominal' => 'required|numeric'
    ];

    if (!$this->validate($rules)) {
        return redirect()->to('/discount')
            ->withInput()
            ->with('error', $this->validator->listErrors());
    }

    $this->discountModel->save([
        'tanggal' => $this->request->getPost('tanggal'),
        'nominal' => $this->request->getPost('nominal')
    ]);

    return redirect()->to('/discount')
        ->with('success', 'Data berhasil ditambahkan.');
}
    public function update($id)
{
    $this->discountModel->update($id, [
        'nominal' => $this->request->getPost('nominal')
    ]);

    return redirect()->to('/discount')
        ->with('success', 'Data berhasil diubah.');
}
}