<?php

namespace App\Exports;

use App\Models\Booking;
use App\Models\User;
use App\Models\Package;

use Maatwebsite\Excel\Concerns\FromCollection;

class BookingExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $bookings = Booking::all();
        $data = []; // Initialize an empty array

        foreach ($bookings as $item) {
            $user = User::find($item->user_id);
            $package = Package::find($item->package_id);

            $data[] = [
                'ID' => $item->id,
                'User Name' => $user->name ?? 'N/A',
                'Package Title' => $package->title ?? 'N/A',
                'Package Price' => $package->price ?? 'N/A',
                'User Email' => $user->email ?? 'N/A',
                'User Phone' => $user->phone_number ?? 'N/A',
                'Booking Type' => $item->booking_type,
                'Status' => $item->status,
            ];
        }

        return collect($data); // Convert array to collection
    }

    // Add this method to define the headings
    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Package Title',
            'Package Price',
            'User Email',
            'User Phone',
            'Booking Type',
            'Status',
        ];
    }

}
