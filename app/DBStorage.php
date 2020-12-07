<?php

namespace App;

use Darryldecode\Cart\CartCollection;

class DBStorage
{

    /**
     * @param $key
     * @return mixed
     */
    public function has($key)
    {
        return DatabaseStorageModel::find($key);
    }

    /**
     * @param $key
     * @return array|CartCollection
     */
    public function get($key)
    {
        if ($this->has($key)) {
            return new CartCollection(DatabaseStorageModel::find($key)->cart_data);
        } else {
            return [];
        }
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function put($key, $value): void
    {
        if ($row = DatabaseStorageModel::find($key)) {
            // update
            $row->cart_data = $value;
            $row->save();
        } else {
            DatabaseStorageModel::create([
                'id' => $key,
                'cart_data' => $value
            ]);
        }
    }
}
