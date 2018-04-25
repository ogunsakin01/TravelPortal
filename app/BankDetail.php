<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    protected $fillable = [
        'id',
        'account_name',
        'account_number',
        'bank_id',
        'bank_branch',
        'ifsc_code',
        'pan',
        'status'
    ];

    public function fetchBankDetails()
    {
        return static::where('status',1)
            ->pluck('account_number', 'id')->all();
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function getBankDetails($id)
    {
        $detail = static::where('id', $id)->first();

        $data = [
            'account_name' => $detail->account_name,
            'bank_name' => $detail->bank->bank_name,
            'account_number' => $detail->account_number,
            'bank_id' =>  $detail->bank_id,
            'bank_branch' => $detail->bank_branch,
            'ifsc_code' => $detail->ifsc_code,
            'pan' => $detail->pan,
            'status' => $detail->status
        ];

        return $data;
    }

    public static function storeOrUpdate($data){
        $bankDetails = static::updateOrCreate(
            [
                'id' => $data->id
            ],
            [
                'account_name'     => $data->account_name,
                'account_number'   => $data->account_number,
                'bank_id'          => $data->bank_id,
                'bank_branch'      => $data->bank_branch,
                'ifsc_code'        => $data->bank_ifsc_code,
                'pan'              => $data->bank_pan_code,
                'status'           => 0
            ]
        );

        return $bankDetails;

    }

    public static function getAllBankDetails(){
        return static::all();
    }

    public static function activateBankDetails($id){
        $bankDetails = static::find($id);
        $bankDetails->status = 1;
        $bankDetails->update();
        return $bankDetails;
    }

    public static function deActivateBankDetails($id){
        $bankDetails = static::find($id);
        $bankDetails->status = 0;
        $bankDetails->update();
        return $bankDetails;
    }

    public static function deleteBankDetails(){

    }

    public static function getActiveBanksDetails(){
        return static::where('status',1)->get();
    }
}
