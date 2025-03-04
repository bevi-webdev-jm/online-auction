<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Item;
use App\Models\Company;

class AuctionEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('auction edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'item_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    try {
                        $decryptedId = decrypt($value); // Decrypt the company_id
    
                        if (!Item::where('id', $decryptedId)->exists()) {
                            $fail('The selected item is invalid.');
                        }
                    } catch (\Exception $e) {
                        $fail('Invalid item ID.');
                    }
                }
            ],
            'company_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    try {
                        $decryptedId = decrypt($value); // Decrypt the company_id
    
                        if (!Company::where('id', $decryptedId)->exists()) {
                            $fail('The selected company is invalid.');
                        }
                    } catch (\Exception $e) {
                        $fail('Invalid company ID.');
                    }
                }
            ],
            'start' => [
                'required',
                'date',
                'after_or_equal:today' // Prevents setting past start dates
            ],
            'start_time' => [
                'required',
            ],
            'end' => [
                'required',
                'date',
                'after_or_equal:start' // Ensures end date is after start date
            ],
            'end_time' => [
                'required',
            ],
            'min_bid' => [
                'required'
            ],
            'bid_limit' => [
                'required_if:user_bidding_limit,1'
            ]
        ];
    }
}
