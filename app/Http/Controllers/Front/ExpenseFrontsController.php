<?php

namespace App\Http\Controllers\Front;

use App\Classes\Files;
use App\Classes\Reply;
use App\Http\Controllers\FrontBaseController;
use App\Http\Requests\Front\Expense\ExpenseStore;

use App\Models\Expense;
use Carbon\Carbon;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class ExpenseFrontsController extends FrontBaseController
{

    public function __construct()
    {

        parent::__construct();
        $this->pageTitle = Lang::get('core.jobTitle');
        $this->accountActive = 'active';
    }

    public function index()
    {
        $this->expenses = Expense::where('expenses.employee_id', employee()->id)->get();

        return View::make('front.expense.index', $this->data);
    }

    // Datatable ajax request
    public function ajax_expenses()
    {
        $result = Expense::select('expenses.id', 'item_name', 'purchase_from', 'purchase_date', 'bill', 'price', 'expenses.status')
            ->where('expenses.employee_id', employee()->id)
            ->orderBy('expenses.id', 'desc')->get();

        return DataTables::of($result)->editColumn('purchase_date', function ($row) {
            return date('Y-m-d', strtotime($row->purchase_date));
        })->editColumn('status', function ($row) {
            if ($row->status == 'rejected') {
                return "<span class='badge badge-danger'>rejected</span>";
            }if ($row->status == 'pending') {
                return "<span class='badge badge-warning'>pending</span>";
            }if ($row->status == 'approved') {
                return "<span class='badge badge-success'>approved</span>";
            }
        })->editColumn('bill', function ($row) {
            if(!is_null($row->bill)){
               return  '<a  href="'.$row->bill_url.'"
                                               target="_blank" class="btn btn-primary btn-sm">File Uploaded</a>' ;
            }
            return '';

        })
            ->rawColumns(['status','bill'])
            ->make();
    }


    public function create()
    {
        return View::make('front.expense.create', $this->data);
    }

    /***
     * @param ExpenseStore $request
     * @return array
     * @throws \Exception
     */
    public function store(ExpenseStore $request)
    {

        $request->purchase_date =  $request->purchase_date;
        $expense = Expense::create($request->toArray());

        if ($request->hasFile('bill')) {
            $file = new Files();
            $filename = $file->upload($request->file('bill'), 'expense/bills', null, null, false);
            $expense->bill = $filename;
            $expense->save();
        }

        return response()->json(['status'=>'success', 'message' => 'Expense added successfully']);


    }


}
