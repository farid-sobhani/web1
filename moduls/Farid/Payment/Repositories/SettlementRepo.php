<?php

namespace Farid\Payment\Repositories;



use Farid\Payment\Models\Settlement;
use Farid\User\Models\User;

class SettlementRepo
{
    public function store($amount)
    {
        return Settlement::create([
           'user_id' => auth()->id(),
            'amount' => $amount,
        ]);
    }

    public function checkUserPendingRequests()
    {
        $q = Settlement::where('user_id',auth()->id())->where('status',Settlement::STATUS_PENDING)->first();

        if ($q) {
            return true;
        }
        return false;
    }
    public function resetToZero(){
        $user = User::find(auth()->id());
        $user->update([
            'balance' => 0
        ]);
    }

    public function all()
    {
        return Settlement::query()->latest()->get();
    }

    public function find($id)
    {
        return Settlement::find($id);
    }

    public function accept($id , $transaction_id)
    {
        return $this->find($id)->update([
           'status' => Settlement::STATUS_SETTLED,
           'settled_at' => now(),
           'transaction_id' => $transaction_id
        ]);
    }
}
