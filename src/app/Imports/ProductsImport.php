<?php

namespace App\Imports;

use App\Models\ProductType;
use App\Models\User;
use App\Notifications\ProductsUploaded;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    public $userId;
    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    /**
     * @param array $rows
     *
     * @return void
     */

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index != 0) {
                $productType = ProductType::where('name', $row[3])->first();
                if (!is_null($productType)) {
                    $productType->products()->firstOrCreate(
                        ['description' => $row[0]],
                        [
                            'description' => $row[0],
                            'quantity' => $row[1],
                            'price' => $row[2],
                        ]
                    );
                }
            }
        }
        $user = User::find($this->userId);
        if($user != null)
        {
            $user->notify(new ProductsUploaded());
        }

    }
}
