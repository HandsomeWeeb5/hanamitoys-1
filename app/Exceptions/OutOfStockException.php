<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * OutOfStockException
 */
class OutOfStockException extends Exception
{
  /**
   * Report the exception
   *
   * @return void
   */
  public function report()
  {
    Log::debug('The product is out of stock');
  }
}
