<?php

namespace App\Database\Seeds;

use App\Models\ItemModel;
use CodeIgniter\I18n\Time;
use App\Models\JournalModel;
use CodeIgniter\Database\Seeder;
use App\Models\PurchaseOrderModel;
use App\Models\PurchaseDetailModel;
use App\Models\JournalTransactionModel;

class PurchaseOrderSeeder extends Seeder
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

        $purchaseId = $this->storePurchase([
            'document' => null,
            'journal_id' => $journalId,
            'status' => 'paid',
            'date' => Time::now(),
            'description' => 'Pembelian Barang Tabu7ng Gas LPG 3kg dan Isinya'
        ]);

        $result1 = $this->storePurchaseDetails([
            'purchase_order_id' => $purchaseId,
            'qty' => 30,
            'item_id' => 1,
            'total_price' => 110000 * 30,
        ]);

        $result2 = $this->storePurchaseDetails([
            'purchase_order_id' => $purchaseId,
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

    public function storePurchase(array $data) : int
    {
        $purchases = new PurchaseOrderModel();
        $purchases->insert([
            'business_partner_id' => 1,
            'store_id' => 1,
            'document' => $data['document'],
            'journal_id' => $data['journal_id'],
            'status' => $data['status'],
            'date' => $data['date'],
            'description' => $data['description']
        ]);

        return $purchases->getInsertID();
    }

    public function storePurchaseDetails(array $array): array
    {
        $purchaseDetails = new PurchaseDetailModel();
        $items = new ItemModel();
        $data = [
            'purchase_order_id' => $array['purchase_order_id'],
            'qty' => $array['qty'],
            'item_id' => $array['item_id'],
            'total_price' => $array['total_price'],
        ];
        
        $purchaseDetails->insert($data);
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
