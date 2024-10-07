<?php

use App\Http\Controllers\EmployeeController;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('welcome');

});


Route::get("/Buoi1", function() {

    // BTVN

    // B1

    $query1 = DB::table("users", "u")
        ->select("u.name", DB::raw("SUM(o.amount) as total_spent"))
        ->join("orders as o", "u.id", "o.user_id")
        ->groupBy("u.name")
        ->having("total_spent", ">", 1000)
        ->toRawSql();


    $query2 = DB::table("orders")
        ->select(DB::raw("DATE(order_date) as date"), DB::raw("COUNT(*) as orders_count"), DB::raw("SUM(total_amount) as total_sales"))
        ->whereBetween("order_date", ["2024-01-01", "2024-09-30"])
        ->groupBy(DB::raw("DATE(order_date)"))
        ->toRawSql();


    $query3 = DB::table("products", "p")
        ->select("product_name")
        ->whereNotExists(function (Builder $query) {
            $query->select(1)
                ->from("orders", "o")
                ->where("o.product_id", "p.id");
        })
        ->toRawSql();


    $query4 = DB::table("products", "p")
        ->select("p.product_name", "s.total_sold")
        ->joinSub(function (Builder $query) {
            $query->select("product_id", DB::raw("SUM(quantity) as total_sold"))
                ->from("sales")
                ->groupBy("product_id");
        }, "s", "p.id", "s.product_id")
        ->where("s.total_sold", ">", 100)
        ->toRawSql();


    $query5 = DB::table("users", "u")
        ->select("users.name", "products.product_name", "orders.order_date")
        ->join("orders as o", "u.id", "o,user_id")
        ->join("order_items as oi", "o.id", "oi.order_id")
        ->join("products as p", "oi.product_id", "p.id")
        ->where("o.order_date", ">=", DB::raw("NOW() - INTERVAL 30 DAY"))
        ->toRawSql();

    $query6 = DB::table("orders", "o")
        ->select(
            DB::raw("DATE_FORMAT(o.order_date, '%Y-%m') as order_month"),
            DB::raw("SUM(oi.price * oi.quantity) as total_revenue")
        )
        ->join("order_items as oi", "o.id", "oi.order_id")
        ->where("o.status", "completed")
        ->groupBy("order_month")
        ->orderByDesc("order_month")
        ->toRawSql();


    $query7 = DB::table("products", "p")
        ->select("product_name")
        ->leftJoin("order_items as oi", "p.id", "oi.product_id")
        ->whereNull("oi.product_id")
        ->toRawSql();

    $query8 = DB::table("products", "p")
        ->select("p.category_id", "p.product_name", DB::raw("MAX(oi.total) as max_revenue"))
        ->joinSub(function (Builder $query) {
            $query->select(
                    "product_id",
                    DB::raw("SUM(quantity * price) as total")
                )
                ->from("order_items")
                ->groupBy("product_id");
        }, "oi", "p.id", "oi.product_id")
        ->groupBy(["p.category_id", "p.product_name"])
        ->orderByDesc("max_revenue")
        ->toRawSql();

    $query9 = DB::table("orders", "o")
        ->select(
            "orders.id",
            "users.name",
            DB::raw("SUM(oi.quantity * oi.price as total_value")
        )
        ->join("users as u", "o.user_id", "u.id")
        ->join("order_items as oi", "o.id", "oi.order_id")
        ->groupBy("o.id", "u.name", "o.order_date")
        ->havingNested(function(Builder $query) {
            $sumOrderItem = DB::table("order_items")
                ->select(DB::raw("SUM(qunatity * price) as total"))
                ->groupBy("order_id")
                ->toSql();

            $avgOrderValue = DB::table("($sumOrderItem)")
                ->select(DB::raw("AVG(total)"))
                ->toSql();

            $query->having('total_value', '>', DB::raw("($avgOrderValue) as avg_order_value"));
        })
        ->toRawSql();

    $query10 = DB::table("products", "p")
        ->select("p.category_id", "p.product_name", DB::raw("SUM(oi.quantity) as total_sold"))
        ->join("order_items as oi", "p.id", "oi.product_id")
        ->groupBy(["p.category_id", "p.product_name"])
        ->havingNested(function (Builder $query) {
            $totalSoldProduct = DB::table("order_items")
                ->select("product_name", DB::raw("SUM(quantity) as total_sold"))
                ->join("products", "order_items.product_id", "product.id")
                ->whereColumn("products.category_id", "p.category_id")
                ->groupBy("product_name")
                ->toSql();

            $sub = DB::table(DB::raw("($totalSoldProduct) as sub"))
                ->select(DB::raw("MAX(sub.total_sold)"))
                ->toSql();

            $query->having("total_sold", "($sub)");
        })
        ->toRawSql();

    dd($query1, $query2, $query3, $query4, $query5, $query6, $query7, $query8, $query9, $query10);



    // B2

    // 1. Eloquent ORM là gì trong Laravel?

        /**
         * Eloquent ORM là công cụ hỗ trợ truy vấn giống Query Builder
         */

    // 2. Laravel Eloquent có các quy ước mặc định nào khi ánh xạ giữa tên model và bảng trong cơ sở dữ liệu?

        /**
         * Laravel Eloquent có quy ước đặt tên như sau:
         *  + Tên bảng là số ít
         *  + Viết tên bảng theo kiểu PascalCase
         */

    // 3. Làm thế nào để thay đổi tên bảng (table) và khóa chính (primary key) mặc định trong Eloquent?
        /**
         * Thay đổi tên bảng mặc định trong Eloquent: khai báo protected $table = "Thay đổi tên bảng mặc định"
         * Thay đổi khóa chính mặc định trong Eloquent: khai báo protected $primaryKey = "Thay đổi khóa chính mặc định"
         */

    // 4. CRUD với Eloquent ORM như nào?
        /**
         * C: Product::query()->insert([$data]);
         * R: Product::query()->all();
         * U: Product::query()->where('id', 1)->update([$dataNew]);
         * D: Product::destroy(1);
         */



});


Route::get("/Buoi2", function() {
    // BTVN
    $salesByMonth = \App\Models\Sale::query()
        ->select(
            DB::raw('SUM(total) as total_sales'),
            DB::raw('EXTRACT(MONTH FROM sale_date) as month'),
            DB::raw("EXTRACT(YEAR FROM sale_date) as year")
        )
        ->groupBy([
            "EXTRACT(MONTH FROM sale_date)",
            "EXTRACT(YEAR FROM sale_date)"
        ])
        ->toRawSql();

    $salesByMonthQB = DB::table('sales')
        ->select(
            DB::raw('SUM(total) as total_sales'),
            DB::raw('EXTRACT(MONTH FROM sale_date) as month'),
            DB::raw("EXTRACT(YEAR FROM sale_date) as year")
        )
        ->groupBy([
            "EXTRACT(MONTH FROM sale_date)",
            "EXTRACT(YEAR FROM sale_date)"
        ])
        ->toRawSql();

    $expensesByMonth = \App\Models\Expense::query()
        ->select(
            DB::raw('SUM(total) as total_expenses'),
            DB::raw('EXTRACT(MONTH FROM expense_date) as month'),
            DB::raw("EXTRACT(YEAR FROM expense_date) as year")
        )
        ->groupBy([
            "EXTRACT(MONTH FROM expense_date)",
            "EXTRACT(YEAR FROM expense_date)"
        ])
        ->toRawSql();

    $expensesByMonthDB = DB::table('expenses')
        ->select(
            DB::raw('SUM(total) as total_expenses'),
            DB::raw('EXTRACT(MONTH FROM expense_date) as month'),
            DB::raw("EXTRACT(YEAR FROM expense_date) as year")
        )
        ->groupBy([
            "EXTRACT(MONTH FROM expense_date)",
            "EXTRACT(YEAR FROM expense_date)"
        ])
        ->toRawSql();


    $month = 9;
    $year = 2024;

    $totalSales = DB::table('sales')
        ->whereMonth('sale_date', $month)
        ->whereYear('sale_date', $year)
        ->sum('total');

    $totalExpenses = DB::table('expenses')
        ->whereMonth('expense_date', $month)
        ->whereYear('expense_date', $year)
        ->sum('amount');


    $vatRate = DB::table('taxes')
        ->select('rate')
        ->where('tax_name', 'VAT')
        ->value('rate');

    $profitBeforeTax = $totalSales - $totalExpenses;
    $taxAmount = $totalSales * $vatRate;
    $profitAfterTax = $profitBeforeTax - $taxAmount;

    // DB::table('financial_reports')->insert([
    //     'month' => $month,
    //     'year' => $year,
    //     'total_sales' => $totalSales,
    //     'total_expenses' => $totalExpenses,
    //     'profit_before_tax' => $profitBeforeTax,
    //     'tax_amount' => $taxAmount,
    //     'profit_after_tax' => $profitAfterTax,
    // ]);

    \App\Models\FinancialReport::query()->insert([
        'month' => $month,
        'year' => $year,
        'total_sales' => $totalSales,
        'total_expenses' => $totalExpenses,
        'profit_before_tax' => $profitBeforeTax,
        'tax_amount' => $taxAmount,
        'profit_after_tax' => $profitAfterTax,
    ]);

    echo "create new financial reports success";
    dd($salesByMonth, $expensesByMonth);

});


// BUOI 3
Route::resource('employees', \App\Http\Controllers\EmployeeController::class);
Route::delete('employees/{employee}/forceDelete', [EmployeeController::class, 'forceDelete'])->name('employees.forceDelete');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
