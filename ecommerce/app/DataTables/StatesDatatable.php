<?php

namespace App\DataTables;

use App\Model\State;
use Yajra\DataTables\Services\DataTable;

class StatesDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', 'admin.states.btn.checkbox')
            ->addColumn('edit', 'admin.states.btn.edit')
            ->addColumn('delete', 'admin.states.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
                'checkbox',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return State::query()->with('country_id')->with('city_id')->select('states.*');
    }
   

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                  //  ->addAction(['width' => '80px'])
                    //->parameters($this->getBuilderParameters());
                    ->parameters([
                        'dom'=>'Blfrtip',
                        'lengthMenu'=>[[10,25,50,100,-1],[10,25,50,100,'All recored']],
                        'buttons'=>[
                            ['className'=>'btn btn-primary','text'=>'<i class="fa fa-plus"></i>'.trans('admin.add'),'action'=>'function(){
                                window.location.href="'.\URL::current().'/create";
                            }'],
                            ['extend'=>'print','className'=>'btn btn-info','text'=>'<i class="fa fa-print"></i> print'],
                            ['extend'=>'csv','className'=>'btn btn-info','text'=>'<i class="fa fa-file"></i> Csv Export'],
                            ['extend'=>'excel','className'=>'btn btn-success','text'=>'<i class="fa fa-file"></i> Excel Export'],
                            ['extend'=>'pdf','className'=>'btn btn-primary','text'=>'<i class="fa fa-file"></i> PDF'],
                            ['extend'=>'reload','className'=>'btn btn-warning','text'=>'<i class="fa fa-refresh"></i> Refresh'],
                            ['className'=>'btn btn-danger delBtn','text'=>'<i class="fa fa-trash"></i>'.trans('admin.delete_all')],
                                                ],
                        'initComplete' => "function () {
                            this.api().columns([2,3]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }", 
                        'language'=>datatable_lang(),
                       
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
            [
                'name'=>'checkbox',
                'data'=>'checkbox',
                'title'=>'<input type="checkbox" class="check_all" onclick="check_all()"/>',
                'searchable'=>false,
                'orderable'=>false,
                'exportable'=>false,
                'printable'=>false,
                'sortable'=>false,
            ],
            [
                'name'=>'id',
                'data'=>'id',
                'title'=>'#',
            ],[
                'name'=>'state_name_ar',
                'data'=>'state_name_ar',
                'title'=>trans('admin.state_name_ar'),
            ],[
                'name'=>'state_name_en',
                'data'=>'state_name_en',
                'title'=>trans('admin.state_name_en'),
            ],[
                'name'=>'country_id.country_name_'.Session('lang'),
                'data'=>'country_id.country_name_'.Session('lang'),
                'title'=>trans('admin.country_id'),
            ],[
                'name'=>'city_id.city_name_'.Session('lang'),
                'data'=>'city_id.city_name_'.Session('lang'),
                'title'=>trans('admin.city_id'),
            ],[
                'name'=>'created_at',
                'data'=>'created_at',
                'title'=>trans('admin.created_at'),
            ],[
                'name'=>'updated_at',
                'data'=>'updated_at',
                'title'=>trans('admin.updated_at'),
                
            ],[
                'name'=>'edit',
                'data'=>'edit',
                'title'=>trans('admin.edit'),
                'searchable'=>false,
                'orderable'=>false,
                'exportable'=>false,
                'printable'=>false,
            ],[
                'name'=>'delete',
                'data'=>'delete',
                'title'=>trans('admin.delete'),
                'searchable'=>false,
                'orderable'=>false,
                'exportable'=>false,
                'printable'=>false,
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'States_' . date('YmdHis');
    }
}
