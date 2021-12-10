<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDatatable extends DataTable
{
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
            ->addColumn('edit', 'dashboard.users.btns.edit')
            ->addColumn('delete', 'dashboard.users.btns.delete')
            ->addColumn('checkbox', 'dashboard.users.btns.checkbox')
            ->addColumn('created_at',function ($row){
                return $row->created_at->format('d-m-Y');
            })
            ->addColumn('updated_at',function ($row){
                return $row->updated_at->format('d-m-Y');
            })
            ->rawColumns(['edit','delete','checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UserDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->where(function($query){
            if (request()->has('level')) {
                return $query->where('level',request('level'));
            }

        });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('Userdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make(['className' => 'btn btn-success',
                                        'text' =>'<i class="fa fa-plus"> '.__('site.create').'</i>',
                                        'action'=>"function(){
                                            window.location.href='".\URL::current()."/create';
                                        }",
                                    ]),
                        Button::make(['extend' =>'print','className' => 'btn btn-primary','text' =>'<i class="fa fa-print"> '.__('site.print').'</i>']),
                        Button::make(['extend' =>'export','className' => 'btn btn-info','text' =>'<i class="fa fa-file"> '.__('site.export').'</i>']),
                        Button::make(['className' => 'btn btn-danger del-btn',
                                        'text' =>'<i class="fa fa-trash"> '.__('site.delete_all').'</i>',
                                    ]),
                        Button::make(['extend' =>'reload','className' => 'btn btn-default','text' =>'<i class="fa fa-sync"></i>'])

                    )
                    ->parameters([
                        'lengthMenu'=>[[10,25,50,100],[10,25,50,__('site.all')]],
                        'initComplete'=>"function() {
                            this.api().columns([3,4]).every(function () {
                                var column = this;
                                var input = document.createElement('input');
                                $(input).appendTo($(column.footer()).empty())
                                .css('width', 'auto' )
                                .on('keyup', function () {
                                    column.search($(this).val(),false, false, true).draw();
                                });
                            });
                        }",
                        'language'         => [
                            'sProcessing'     => __('site.sProcessing'),
                            'sLengthMenu'     => __('site.sLengthMenu'),
                            'sZeroRecords'    => __('site.sZeroRecords'),
                            'sEmptyTable'     => __('site.sEmptyTable'),
                            'sInfo'           => __('site.sInfo'),
                            'sInfoEmpty'      => __('site.sInfoEmpty'),
                            'sInfoFiltered'   => __('site.sInfoFiltered'),
                            'sInfoPostFix'    => __('site.sInfoPostFix'),
                            'sSearch'         => __('site.sSearch'),
                            'sUrl'            => __('site.sUrl'),
                            'sInfoThousands'  => __('site.sInfoThousands'),
                            'sLoadingRecords' => __('site.sLoadingRecords'),
                            'oPaginate'       => [
                                'sFirst'         => __('site.sFirst'),
                                'sLast'          => __('site.sLast'),
                                'sNext'          => __('site.sNext'),
                                'sPrevious'      => __('site.sPrevious'),
                            ],
                            'oAria'            => [
                                'sSortAscending'  => __('site.sSortAscending'),
                                'sSortDescending' => __('site.sSortDescending'),
                            ],
        
                        ],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('checkbox' )
                ->title('<input type="checkbox" class="check-all" name="checkall" onclick="check_all()"/>')
                ->exportable(false)
                ->printable(false)
                ->width("60")
                ->orderable(false)
                ->searchable(false)
                ->addClass('text-center'),
            Column::make('id')->title('#'),
            Column::make('level' )->title(__('site.level')),
            Column::make('name' )->title(__('site.name')),
            Column::make('email')->title(__('site.email')),
            Column::make('created_at')->title('created at'),
            Column::make('updated_at')->title('updated at'),
            Column::computed('edit')
                ->title(__('site.edit'))
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->width("60")
                ->addClass('text-center'),
            Column::computed('delete')
                ->title(__('site.delete'))
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
