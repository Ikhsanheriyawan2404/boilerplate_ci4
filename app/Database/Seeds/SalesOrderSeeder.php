<?php

namespace App\Database\Seeds;

use App\Models\ItemModel;
use CodeIgniter\I18n\Time;
use App\Models\JournalModel;
use App\Models\SalesOrderModel;
use App\Models\SalesDetailModel;
use CodeIgniter\Database\Seeder;
use App\Models\JournalTransactionModel;

class SalesOrderSeeder extends Seeder
{
    protected $bankBRI = '11201';
    protected $kas = '11000';
    protected $modal = '31000';
    protected $persedianBarang = '10300';
    protected $pendapatan = '41000';

    public function run()
    {   
        $journalId = $this->storeJournal([
            'store_id' => 1,
            'transaction_number' => 'Journal#1004',
            'date' => Time::now(),
            'description' => 'Pembelian Barang Tabu7ng Gas LPG 3kg dan isinya'
        ]);

        $saleId = $this->storeSales([
            'document' => null,
            'journal_id' => $journalId,
            'status' => 'paid',
            'date' => Time::now(),
            'description' => 'Pembelian Barang Tabu7ng Gas LPG 3kg dan Isinya'
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
            'account_code' => $this->persedianBarang,
            'journal_id' => $journalId,
            'debit' => $result1['total_price'] + $result2['total_price'],
            'credit' => 0,
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->bankBRI,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => $result1['total_price'] + $result2['total_price'],
        ]);
    }

    public function storeSales(array $data) : int
    {
        $sales = new SalesOrderModel();
        $sales->insert([
            'business_partner_id' => 1,
            'store_id' => 1,
            'document' => $data['document'],
            'journal_id' => $data['journal_id'],
            'status' => $data['status'],
            'date' => $data['date'],
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
            'stock' => $item->stock + $data['qty'],
        ]);

        return $data;
    }

    public function storeJournal(array $data) : int
    {
        $journals = new JournalModel();
        $journals->insert([
            'store_id' => 1,
            'journal_type_id' => random_int(1, 6),
            'transaction_number' => $data['transaction_number'],
            'date' => $data['date'],
            'description' => $data['description']
        ]);

        return $journals->getInsertID();
    }

    public function storeDetailJournal(array $array)
    {
        $transactions = new JournalTransactionModel();
        // $accounts = new AccountModel();
        $data = [
            'store_id' => $array['store_id'],
            'account_code' => $array['account_code'],
            'journal_id' => $array['journal_id'],
            'debit' => $array['debit'],
            'credit' => $array['credit'],
        ];
        $transactions->insert($data);
        // $account = $accounts->where('code', $data['account_code'])->first();
        // $accounts->update($account->id, [
        //     'debit' => $account->debit + $data['debit'],
        //     'credit' => $account->credit + $data['credit'],
        // ]);
    }
}
