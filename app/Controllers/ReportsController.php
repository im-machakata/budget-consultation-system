<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Report;
use CodeIgniter\HTTP\ResponseInterface;

class ReportsController extends BaseController
{
    public function index()
    {
        $reports = model(Report::class);
        return view('reports/index', [
            'reports' => $reports->orderBy('id', 'DESC')->paginate(10),
            'pager' => $reports->pager
        ]);
    }
    public function create()
    {
        $reports = model(Report::class);
        $validated = $this->validate([
            'item' => 'required|min_length[5]|max_length[255]',
            'due_date' => 'required|valid_date',
            'quantity' => 'required|greater_than[0]',
        ]);

        if (!$validated) return redirect()->back()->with('reports/index', [
            'errors' => $this->validator->getErrors(),
            'reports' => $reports->orderBy('id', 'DESC')->paginate(10),
            'pager' => $reports->pager
        ]);
        $newItem = $this->request->getPost();
        $newItem['user_id'] = session()->get('user')->id;

        // save new item
        model(Report::class)->save($newItem);
        return redirect()->back();
    }
}
