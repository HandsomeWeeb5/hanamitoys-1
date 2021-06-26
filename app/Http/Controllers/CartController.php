<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;

class CartController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $items = \Cart::getContent();
    $this->data['items'] =  $items;

    return view('customer.carts.index', $this->data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $params = $request->except('_token');

    $product = Product::findOrFail($params['product_id']);
    $attributes = [];
    if ($product->configurable()) {
      $product = Product::from('products as p')
        ->whereRaw("p.parent_id = :parent_product_id
							and (select pav.text_value 
									from product_attribute_values pav
									join attributes a on a.id = pav.attribute_id
									where a.code = :figure_code
									and pav.product_id = p.id
									limit 1
								) = :figure_value
								", [
          'parent_product_id' => $product->id,
          'figure_code' => 'figure',
          'figure_value' => $params['figure'],
        ])->firstOrFail();
      $attributes['figure'] = $params['figure'];
    }

    $itemQuantity =  $this->_getItemQuantity(md5($product->id)) + $params['qty'];
    $this->_checkProductInventory($product, $itemQuantity);

    $item = [
      'id' => md5($product->id),
      'name' => $product->name,
      'price' => $product->price,
      'quantity' => $params['qty'],
      'attributes' => $attributes,
      'associatedModel' => $product,
    ];

    \Cart::add($item);

    Toastr::success('Produk ' . $item['name'] . ' telah ditambahkan kedalam keranjang', 'Sukses');
    return redirect()->back();
  }

  /**
   * Get total quantity per item in the cart
   *
   * @param string $itemId item ID
   *
   * @return int
   */
  private function _getItemQuantity($itemId)
  {
    $items = \Cart::getContent();
    $itemQuantity = 0;
    if ($items) {
      foreach ($items as $item) {
        if ($item->id == $itemId) {
          $itemQuantity = $item->quantity;
          break;
        }
      }
    }

    return $itemQuantity;
  }

  /**
   * Check product inventory
   *
   * @param Product $product      product object
   * @param int     $itemQuantity qty
   *
   * @return int
   */
  private function _checkProductInventory($product, $itemQuantity)
  {
    if ($product->productInventory->qty < $itemQuantity) {
      throw new \App\Exceptions\OutOfStockException('The product ' . $product->sku . ' is out of stock');
    }
  }

  /**
   * Get cart item by card item id
   *
   * @param string $cartID cart ID
   *
   * @return array
   */
  private function _getCartItem($cartID)
  {
    $items = \Cart::getContent();

    return $items[$cartID];
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $params = $request->except('_token');

    // Jika tidak ada array items 
    if (empty($params['items'])) {
      Toastr::error('Keranjang gagal diperbarui', 'Gagal');
      return redirect('carts');
    }

    if ($items = $params['items']) {
      foreach ($items as $cartID => $item) {
        $cartItem = $this->_getCartItem($cartID);
        $this->_checkProductInventory($cartItem->associatedModel, $item['quantity']);

        \Cart::update($cartID, [
          'quantity' => [
            'relative' => false,
            'value' => $item['quantity'],
          ],
        ]);
      }

      Toastr::success('Keranjang telah diperbarui', 'Sukses');
      return redirect('carts');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    \Cart::remove($id);

    return redirect('carts');
  }
}
