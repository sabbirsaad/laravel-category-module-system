<?php

namespace Modules\Category\DataTables;

use Modules\Category\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Category> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addIndexColumn()
        ->addColumn('image', function ($row) {
            if (!empty($row->image) && file_exists(public_path('uploads/categories/' . $row->image))) {
                $imageUrl = asset('uploads/categories/' . $row->image);
                return '<img src="'.$imageUrl.'" alt="'.e($row->name).'" class="rounded" style="width:50px; height:50px; object-fit:cover;">';
            }
            // fallback when no image
            return '<div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                        <i class="fa-solid fa-image text-white"></i>
                    </div>';
        })
        ->addColumn('is_parent', fn($row) => $row->is_parent ? 'Yes' : 'No')
        ->addColumn('action', function ($row) {
            $editUrl = route('categories.edit', $row->id);
            $deleteUrl = route('categories.destroy', $row->id);

            return '
                <a href="'.$editUrl.'" class="btn btn-sm btn-warning me-1">Edit</a>
                <form action="'.$deleteUrl.'" method="POST" class="d-inline">
                    '.csrf_field().method_field('DELETE').'
                    <button type="submit" onclick="return confirm(\'Delete this category?\')" class="btn btn-sm btn-danger">Delete</button>
                </form>
            ';
        })
        ->rawColumns(['image', 'action'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Category>
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('category-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1, 'desc')
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('#')->orderable(false)->searchable(false),
            Column::make('name'),
            Column::make('slug'),
            Column::computed('image')->title('Image')->orderable(false)->searchable(false),
            Column::make('is_parent')->title('Is Parent'),
            Column::computed('action')->title('Actions')->orderable(false)->searchable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
