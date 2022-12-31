<?php

namespace App\Database\Seeds;

use Carbon\Carbon;
use App\Models\ItemModel;
use App\Models\JournalModel;
use CodeIgniter\Database\Seeder;
use App\Models\PurchaseOrderModel;
use App\Models\PurchaseDetailModel;
use App\Models\JournalTransactionModel;

class PurchaseOrderSeeder extends Seeder
{
    protected $bankBRI = '10002';
    protected $kas = '10001';
    protected $hutangUsaha = '21000';
    protected $persediaanLpg = '10301';
    protected $persediaanTabung = '10302';

    public function run()
    {   
        $purchaseId = $this->storePurchase([
            'document' => null,
            'status' => 'paid',
            'transaction_date' => Carbon::now()->subdays(2),
            'overdue_date' => Carbon::now(),
            'payment_date' => Carbon::now(),
            'description' => 'Pembelian Tabung LPG 30 units dan Isi 90kg'
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

        $journalId = $this->storeJournal([
            'store_id' => 1,
            'purchase_order_id' => $purchaseId,
            'journal_type_id' => 1,
            'transaction_number' => 'JournalPembelian#1001',
            'date' => Carbon::now()->subdays(2),
            'description' => 'Pembelian Tabung LPG 30 units dan Isi 90kg'
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->persediaanTabung,
            'journal_id' => $journalId,
            'debit' => $result1['total_price'],
            'credit' => 0,
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->persediaanLpg,
            'journal_id' => $journalId,
            'debit' => $result2['total_price'],
            'credit' => 0,
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->hutangUsaha,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => $result1['total_price'] + $result2['total_price'],
        ]);

        $journalId = $this->storeJournal([
            'store_id' => 1,
            'purchase_order_id' => $purchaseId,
            'journal_type_id' => 4,
            'transaction_number' => 'JournalKasPengeluaran#1001',
            'date' => Carbon::now(),
            'description' => 'Pembayaran Tabung LPG 30 units dan Isi 90kg'
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->hutangUsaha,
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
        // ====================================================================

        $purchaseId = $this->storePurchase([
            'document' => null,
            'status' => 'paid',
            'transaction_date' => Carbon::now()->subdays(10),
            'overdue_date' => Carbon::now()->subdays(10),
            'payment_date' => Carbon::now()->subdays(10),
            'description' => 'Pembelian Kas Tabung LPG 50 units dan Isi 150kg'
        ]);

        $journalId = $this->storeJournal([
            'store_id' => 1,
            'journal_type_id' => 4,
            'purchase_order_id' => $purchaseId,
            'transaction_number' => 'JournalKasPengeluaran#1007',
            'date' => Carbon::now()->subdays(10),
            'description' => 'Pembelian Kas Tabung LPG 50 units dan Isi 150kg'
        ]);

        $result1 = $this->storePurchaseDetails([
            'purchase_order_id' => $purchaseId,
            'qty' => 50,
            'item_id' => 1,
            'total_price' => 110000 * 50,
        ]);

        $result2 = $this->storePurchaseDetails([
            'purchase_order_id' => $purchaseId,
            'qty' => 150,
            'item_id' => 2,
            'total_price' => 15000 * 150,
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->persediaanTabung,
            'journal_id' => $journalId,
            'debit' => $result1['total_price'],
            'credit' => 0,
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->persediaanLpg,
            'journal_id' => $journalId,
            'debit' => $result2['total_price'],
            'credit' => 0,
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->bankBRI,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => $result1['total_price'] + $result2['total_price'],
        ]);
        // ====================================================================
        $purchaseId = $this->storePurchase([
            'document' => null,
            'status' => 'paid',
            'transaction_date' => Carbon::now(),
            'overdue_date' => Carbon::now(),
            'payment_date' => Carbon::now(),
            'description' => 'Pembelian Isi Lpg 20 units = 60kg'
        ]);

        $journalId = $this->storeJournal([
            'store_id' => 1,
            'journal_type_id' => 4,
            'purchase_order_id' => $purchaseId,
            'transaction_number' => 'JournalKasPengeluaran#1008',
            'date' => Carbon::now(),
            'description' => 'Pembelian Kas Isi Lpg 20 units = 60kg'
        ]);

        $result2 = $this->storePurchaseDetails([
            'purchase_order_id' => $purchaseId,
            'qty' => 60,
            'item_id' => 2,
            'total_price' => 15000 * 60,
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->persediaanLpg,
            'journal_id' => $journalId,
            'debit' => $result2['total_price'],
            'credit' => 0,
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->bankBRI,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => $result2['total_price'],
        ]);

        // =============================================

        $purchaseId = $this->storePurchase([
            'document' => null,
            'status' => 'paid',
            'transaction_date' => Carbon::now(),
            'overdue_date' => Carbon::now(),
            'payment_date' => Carbon::now(),
            'description' => 'Pembelian Isi Lpg 20 units = 60kg'
        ]);

        $journalId = $this->storeJournal([
            'store_id' => 1,
            'journal_type_id' => 4,
            'purchase_order_id' => $purchaseId,
            'transaction_number' => 'JournalKasPengeluaran#1009',
            'date' => Carbon::now(),
            'description' => 'Pembelian Kas Isi Lpg 20 units = 60kg'
        ]);

        $result2 = $this->storePurchaseDetails([
            'purchase_order_id' => $purchaseId,
            'qty' => 60,
            'item_id' => 2,
            'total_price' => 15000 * 60,
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->persediaanLpg,
            'journal_id' => $journalId,
            'debit' => $result2['total_price'],
            'credit' => 0,
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->bankBRI,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => $result2['total_price'],
        ]);

        // ====================================================================

        $purchaseId = $this->storePurchase([
            'document' => null,
            'status' => 'open',
            'transaction_date' => Carbon::now(),
            'overdue_date' => Carbon::now(),
            'description' => 'Pembelian Isi Lpg 30 units = 90kg'
        ]);

        $journalId = $this->storeJournal([
            'store_id' => 1,
            'journal_type_id' => 1,
            'purchase_order_id' => $purchaseId,
            'transaction_number' => 'JournalPembelian#1008',
            'date' => Carbon::now(),
            'description' => 'Pembelian Isi Lpg 30 units = 90kg'
        ]);

        $result2 = $this->storePurchaseDetails([
            'purchase_order_id' => $purchaseId,
            'qty' => 90,
            'item_id' => 2,
            'total_price' => 15000 * 90,
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->persediaanLpg,
            'journal_id' => $journalId,
            'debit' => $result2['total_price'],
            'credit' => 0,
        ]);

        $this->storeDetailJournal([
            'store_id' => 1,
            'account_code' => $this->hutangUsaha,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => $result2['total_price'],
        ]);
    }

    public function storePurchase(array $data) : int
    {
        $purchases = new PurchaseOrderModel();
        $purchases->insert([
            'business_partner_id' => 1,
            'store_id' => 1,
            'document' => $data['document'],
            'status' => $data['status'],
            'transaction_date' => $data['transaction_date'],
            'overdue_date' => $data['overdue_date'],
            'payment_date' => $data['payment_date'] ?? null,
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
            'journal_type_id' => $data['journal_type_id'] ?? random_int(1, 6),
            'purchase_order_id' => $data['purchase_order_id'],
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
