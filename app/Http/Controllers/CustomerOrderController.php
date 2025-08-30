<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CustomerOrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        
        $customerOrder = CustomerOrder::create([
            'customer_name' => $request->customer_name,
            'contact_number' => $request->contact_number,
            'vehicle_id' => $request->vehicle_id,
            'vehicle_info' => $vehicle->brand->name . ' ' . $vehicle->model . ' (' . $vehicle->year . ')',
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order submitted successfully!'
        ]);
    }

    public function index()
    {
        $orders = CustomerOrder::with('vehicle.brand')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.customer-orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, CustomerOrder $order)
    {
        $request->validate([
            'status' => 'required|in:pending,contacted,completed,cancelled',
            'notes' => 'nullable|string'
        ]);

        $order->update([
            'status' => $request->status,
            'notes' => $request->notes
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully!'
        ]);
    }

    public function export()
    {
        $orders = CustomerOrder::with('vehicle.brand')
            ->orderBy('created_at', 'desc')
            ->get();

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator('Eminent Car Dealership')
            ->setLastModifiedBy('Eminent Car Dealership')
            ->setTitle('Customer Orders Report')
            ->setSubject('Customer Orders Export')
            ->setDescription('Customer orders export from Eminent Car Dealership');

        // Set headers
        $headers = [
            'Order ID',
            'Customer Name',
            'Contact Number',
            'Vehicle Information',
            'Status',
            'Notes',
            'Created Date',
            'Updated Date'
        ];

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $sheet->getColumnDimension($col)->setAutoSize(true);
            $col++;
        }

        // Style the header row
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle('A1:H1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('E2EFDA');

        // Add data
        $row = 2;
        foreach ($orders as $order) {
            $sheet->setCellValue('A' . $row, $order->id);
            $sheet->setCellValue('B' . $row, $order->customer_name);
            $sheet->setCellValue('C' . $row, $order->contact_number);
            $sheet->setCellValue('D' . $row, $order->vehicle_info);
            $sheet->setCellValue('E' . $row, ucfirst($order->status));
            $sheet->setCellValue('F' . $row, $order->notes);
            $sheet->setCellValue('G' . $row, $order->created_at->format('Y-m-d H:i:s'));
            $sheet->setCellValue('H' . $row, $order->updated_at->format('Y-m-d H:i:s'));
            $row++;
        }

        // Add borders
        $sheet->getStyle('A1:H' . ($row - 1))->getBorders()->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Create the Excel file
        $writer = new Xlsx($spreadsheet);
        
        // Set headers for download
        $filename = 'customer_orders_' . date('Y-m-d_H-i-s') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Save file to PHP output
        $writer->save('php://output');
        exit;
    }
}
