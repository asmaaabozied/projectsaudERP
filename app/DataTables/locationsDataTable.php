<?php

namespace App\DataTables;

use App\Helpers\DTHelper;
use App\Models\Location;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class locationsDataTable extends DataTable
{

    private $crudName = 'locations';

    private function getRoutes()
    {
        return [
            'update' => "dashboard.$this->crudName.edit",
            'delete' => "dashboard.$this->crudName.destroy",
            'block' => "dashboard.$this->crudName.block",
        ];
    }

    private function getPermissions()
    {
        return [
            'update' => 'update_' . $this->crudName,
            'delete' => 'delete_' . $this->crudName,
            'create' => 'create_' . $this->crudName
        ];
    }
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($model) {
                $actions = '';

                $actions .= DTHelper::dtEditButton(route('dashboard.locations.edit',$model->id), trans('site.edit'),'dashboard.locations.update');

                $actions .= DTHelper::dtShowButton(route('dashboard.locations.show',$model->id), trans('site.show'),'dashboard.locations.update');
                $actions .= DTHelper::dtDeleteButton(route($this->getRoutes()['delete'], $model->id), trans('site.delete'), $this->getPermissions()['delete']);

//                $actions .= DTHelper::dtDeleteButton(route('dashboard.locations.destroy',$model->id), trans('site.delete'), 'dashboard.locations.update');
//                $actions .= DTHelper::dtBlockActivateButton(route('dashboard.locations.destory', $model->id), $model->active);

                return $actions;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Location $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Location $model)
    {
        return $model->newQuery();
    }
    public function count()
    {
        return Location::all()->count();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('locations-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),

                        Button::make('csv'),
                        Button::make('excel'),

                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('whatsapp')->title(trans('site.whatsapp')),

            Column::make('phone')->title(trans('site.phone')),

            Column::make('name')->title(trans('site.name')),
            Column::make('address')->title(trans('site.address')),
            Column::make('created_at')->title(trans('site.created_at')),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center')
                ->title(trans('site.action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Locations_' . date('YmdHis');
    }
}
