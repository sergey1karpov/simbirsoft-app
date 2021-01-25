<?php

namespace App\Exceptions;

use Exception;

class AdPhotosException extends Exception
{
    public function render() {
    	return redirect()->back()->with('status', 'You can upload no more than 10 additional images');
    }
}
