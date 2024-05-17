<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\ReportEntity;
use App\Models\Report;
use CodeIgniter\HTTP\ResponseInterface;
use UserRoles;

class ReportsController extends BaseController
{
    public function index()
    {
        $user = session()->get('user');
        $reports = model(Report::class);

        // show approved reports only to citizens
        if ($user->roles == UserRoles::CITIZEN) {
            $reports = $reports->where('approved', '1');
        }

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
            'item_price' => 'required|greater_than[0]|decimal',
        ]);

        if (!$validated) return view('reports/index', [
            'errors' => $this->validator->getErrors(),
            'reports' => $reports->orderBy('id', 'DESC')->paginate(10),
            'pager' => $reports->pager
        ]);
        $newItem = new ReportEntity($this->request->getPost());
        $newItem->user_id = session()->get('user')->id;

        // save new item
        model(Report::class)->save($newItem);
        return view('reports/index', [
            'reports' => $reports->orderBy('id', 'DESC')->paginate(10),
            'pager' => $reports->pager
        ]);
    }
    public function approve($id)
    {
        $report = model(Report::class)->find($id);
        if (!$report->approved) {
            $report->approved = (int) true;
            model(Report::class)->save($report);
        }
        return redirect()->to(url('reports'));
    }
    public function reject($id)
    {
        $report = model(Report::class)->find($id);
        if ($report->approved) {
            $report->approved = (int) false;
            model(Report::class)->save($report);
        }
        return redirect()->to(url('reports'));
    }
    public function show($id)
    {
        $report = model(Report::class)->find($id);
        return view('reports/show', [
            'report' => $report
        ]);
    }
}
