<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderStatus;
use App\Models\Driver;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OrderTable extends DataTableComponent
{
    protected $model = Order::class;

    public $drivers;

    public $new_shipment = [
        'openModal' => false,
        'order_id' => '',
        'driver_id' => ''
    ];

    public function mount()
    {
        $this->drivers = Driver::all();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('N° orden', 'id')
                ->sortable(),
            Column::make('Ticket')
                ->label(function ($row) {
                    return view('admin.orders.ticket', ['order' => $row]);
                }),
            Column::make('F. orden', 'created_at')
                ->format(function ($value) {
                    return $value->format('d/m/Y');
                })
                ->sortable(),
            Column::make('total')
                ->format(function ($value) {
                    return '$'.number_format($value, 2);
                })
                ->sortable(),
            Column::make('Cantidad', 'content')
                ->format(function ($value) {
                    return count($value);
                })
                ->sortable(),
            Column::make('Estado', 'status')
                ->format(function ($value) {
                    return $value->name;
                })
                ->sortable(),
            Column::make('Actions')
                ->label(function ($row) {
                    return view('admin.orders.actions', ['order' => $row]);
                }),
        ];
    }

    public function downloadTicket(Order $order)
    {
        return Storage::download($order->pdf_path);
    }

    public function markAsProcessing(Order $order)
    {
        $order->status = OrderStatus::Processing;
        $order->save();
    }

    public function customView():string
    {
        return 'admin.orders.modal';
    }

    public function assignDriver(Order $order)
    {
        $this->new_shipment['order_id'] = $order->id;
        $this->new_shipment['openModal'] = true;
    }

    public function saveShipment()
    {
        $this->validate([
            'new_shipment.driver_id' => 'required|exists:drivers,id'
        ]);

        $order = Order::find($this->new_shipment['order_id']);

        $order->status = OrderStatus::Shipped;

        $order->save();

        $order->shipment()->create([
            'driver_id' => $this->new_shipment['driver_id']
        ]);

        $this->reset('new_shipment');
    }
}