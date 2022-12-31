<?php

namespace App\Database\Seeds;

use Carbon\Carbon;
use App\Models\ItemModel;
use App\Models\JournalModel;
use App\Models\SalesOrderModel;
use App\Models\SalesDetailModel;
use CodeIgniter\Database\Seeder;
use App\Models\JournalTransactionModel;

class SalesOrderSeeder extends Seeder
{
    protected $bankBRI = '10002';
    protected $kas = '10001';
    protected $persediaanLpg = '10301';
    protected $persediaanTabung = '10302';
    protected $pendapatanLpg = '41000';
    protected $pendapatanTabung = '41100';
    protected $hppLpg = '51000';
    protected $hppTabung = '51100';

    public function run()
    {   
        $saleId = $this->storeSales([
            'document' => null,
            'status' => 'paid',
            'transaction_date' => Carbon::now()->subDays(2),
            'overdue_date' => Carbon::now(),
            'payment_date' => Carbon::now(),
            'description' => 'Penjualan Barang Tabung Gas LPG 3kg dan Isinya 30 units dan 90 kg'
        ]);

        $journalId = $this->storeJournal([
            'store_id' => 1,
            'sales_order_id' => $saleId,
            'transaction_number' => 'JournalPenerimaanKas#1001',
            'date' => Carbon::now(),
            'description' => 'Penjualan Barang Tabung Gas LPG 3kg dan isinya'
        ]);

        $result1 = $this->storeSalesDetails([
            'sales_order_id' => $saleId,
            'qty' => 30,
            'item_id' => 1,
            'total_price' => 110000 * 30,
        ]);

        $result2 = $this->storeSalesDetails([
            'sales_order_id' => $saleId,
            'qty' => 90,
            'item_id' => 2,
            'total_price' => 15000 * 90,
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->persediaanTabung,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => $result1['total_price'],
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->persediaanLpg,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => $result2['total_price'],
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->pendapatanTabung,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => $result1['total_price'],
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->pendapatanLpg,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => $result2['total_price'],
        ]);

        // $this->storeDetailJournal([
        //     'store_id' => 1,
        //     'account_code' => $this->hppTabung,
        //     'journal_id' => $journalId,
        //     'debit' => $result2['total_price'],
        //     'credit' => 0,
        // ]);

        // $this->storeDetailJournal([
        //     'store_id' => 1,
        //     'account_code' => $this->hppLpg,
        //     'journal_id' => $journalId,
        //     'debit' => $result2['total_price'],
        //     'credit' => 0,
        // ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->kas,
            'journal_id' => $journalId,
            'debit' => $result1['total_price'] + $result2['total_price'],
            'credit' => 0,
        ]);
    }

    public function storeSales(array $data) : int
    {
        $sales = new SalesOrderModel();
        $sales->insert([
            'business_partner_id' => 2,
            'store_id' => 1,
            'document' => $data['document'],
            'status' => $data['status'],
            'transaction_date' => $data['transaction_date'],
            'overdue_date' => $data['overdue_date'],
            'payment_date' => $data['payment_date'],
            'description' => $data['description']
        ]);

        return $sales->getInsertID();
    }

    public function storeSalesDetails(array $array): array
    {
        $saleDetails = new SalesDetailModel();
        $items = new ItemModel();
        $data = [
            'sales_order_id' => $array['sales_order_id'],
            'qty' => $array['qty'],
            'item_id' => $array['item_id'],
            'total_price' => $array['total_price'],
        ];
        
        $saleDetails->insert($data);
        $item = $items->where('id', $data['item_id'])->first();
        $items->update($data['item_id'], [
            'stock' => $item->stock - $data['qty'],
        ]);

        return $data;
    }

    public function storeJournal(array $data) : int
    {
        $journals = new JournalModel();
        $journals->insert([
            'store_id' => 1,
            'journal_type_id' => random_int(1, 6),
            'sales_order_id' =>  $data['sales_order_id'],
            'transaction_number' => $data['transaction_number'],
            'date' => $data['date'],
            'description' => $data['description']
        ]);

        return $journals->getInsertID();
    }

    public function storeDetailJournal(array $array)
    {
        $transactions = new JournalTransactionModel();
        $data = [
            'store_id' => $array['store_id'],
            'account_code' => $array['account_code'],
            'journal_id' => $array['journal_id'],
            'debit' => $array['debit'],
            'credit' => $array['credit'],
        ];
        $transactions->insert($data);
    }
}
