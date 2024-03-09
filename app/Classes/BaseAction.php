<?php

namespace App\Classes;

use App\Exports\ExcelExport;
use App\Services\BouncerService;
use App\Traits\ApiResponseTrait;
use App\Traits\ElAuthorizeAble;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;
use Maatwebsite\Excel\Facades\Excel;

class BaseAction
{
    use AsAction;
    use ElAuthorizeAble;
    use ApiResponseTrait;

    public function tryDelete($row, $make_message_session = true): bool
    {
        try {
            $row->delete();
            if ($make_message_session)
                $this->makeSuccessSessionMessage();
        } catch (\Throwable  $e) {
            if ($make_message_session)
                $this->makeErrorSessionMessage(__('message.cant_delete'));
            return false;
        }
        return true;
    }

    public function tryForceDelete($row, $make_message_session = false): bool
    {
        $row->forceDelete();
        try {
            $row->forceDelete();
            if ($make_message_session)
                $this->makeSuccessSessionMessage();
        } catch (\Throwable  $e) {
            if ($make_message_session)
                $this->makeErrorSessionMessage(__('message.cant_delete'));
            return false;
        }
        return true;
    }

    public function tryDeleteForceDelete($model, $id, $make_message_session = false): bool
    {
        $row = $model::withTrashed()->findOrFail($id);
        try {
            $row->forceDelete();
            if ($make_message_session)
                $this->makeSuccessSessionMessage();
        } catch (\Throwable  $e) {
            if ($make_message_session)
                $this->makeErrorSessionMessage(__('message.cant_delete'));
            return false;
        }
        return true;
    }

    public function tryRestore($model, $id, $make_message_session = false): void
    {
        $row = $model::withTrashed()->findOrFail($id);
        $row->restore();
        $row->update(['deleted_by_id' => null]);
        if ($make_message_session)
            $this->makeSuccessSessionMessage();
    }

    public function makeSuccessSessionMessage($message = null): void
    {
        $this->createToastr('success', '', $message ?? __('message.success_response_message'));
    }

    private function createToastr($type, $title, $message): void
    {
        Session::flash('toastr', [['type' => $type, 'title' => $title, 'message' => $message]]);
    }

    public function makeErrorSessionMessage($message = null): void
    {
        $this->createToastr('error', '', $message ?? __('message.error_response_message'));
    }

    public function makeErrorCantDeleteMessage($message = null): void
    {
        $this->makeErrorSessionMessage($message ?? __('message.cant_delete'));
    }

    public function breadcrumb(array $items = null, $setPageHeader = true, $share = true): ?array
    {
        if (!$items)
            return null;
        if ($share)
            Inertia::share([
                'breadcrumb' => $items,
            ]);
        if ($setPageHeader)
            $this->pageTitle(
                implode(
                    " - ",
                    array_column(array_slice($items, -2, 2, true), 'label')
                )
            );
        return $items;
    }

    public function allowSearch(): void
    {
        Inertia::share([
            'allowSearch' => true,
        ]);
    }

    public function pageTitle($title): void
    {
        Inertia::share([
            'pageTitle' => $title,
        ]);
    }

    public function exportExcel($data, $map, $file_name, $new_option = []): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new ExcelExport($data, $map, $new_option), $file_name . ' ' . Carbon::now()->toDateString() . '.xlsx');
    }

    public function requestIsExport(Abilities|null $ability=null,$key = 'export_excel'): bool
    {
        if ($ability && !BouncerService::checkAbility($ability)){
            return false;
        }
        return (boolean)request($key);
    }
    public function requestIsExportWithoutAbility($key = 'export_excel'): bool
    {

        return (boolean)request($key);
    }

    public function getPaginateLength()
    {
        return (request('rows') ?? config('app.default_pagination'));
    }

    public function getDataPaginated($query)
    {
        return $query->paginate($this->getPaginateLength())->withQueryString();
    }

}
