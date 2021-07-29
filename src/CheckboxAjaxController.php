<?php

namespace inf1111\CheckboxAjax;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class CheckboxAjaxController extends Controller
{

    /**
     * Action for "check_ajax" type columns
     */
    public function __invoke()
    {

        $validator = Validator::make(request()->only(['entryId', 'className', 'property']), [
            'entryId' => ['bail', 'required', 'integer'],
            'className' => ['bail', 'required', 'string', 'min:3', 'max:50'],
            'property' => ['bail', 'required', 'string', 'min:3', 'max:50'],
            'action' => ['bail', 'string', 'min:3', 'max:50'],
        ]);
        if($validator->fails()) {
            throw new ValidationException($validator);
        }

        $className = '\\' . urldecode(request()->className);

        $entyObj = $className::withoutGlobalScopes()->find(request()->entryId);

        $oldVal = $entyObj->{request()->property};

        // find DB field type
        $tablename = $className::query()->getQuery()->from;
        $DBFields = DB::select('DESCRIBE ' . $tablename);
        $DBFieldsCollection = collect($DBFields)->keyBy('Field');
        $propertyType = $DBFieldsCollection[request()->property]->Type;

        if (preg_match("/date|datetime|timestamp/Uis", $propertyType)) {

            $newVal = ((bool) strtotime($oldVal)) ? null : now();

        } else {

            if ($oldVal == 1 || $oldVal == '1') {

                $newVal = '0';

            } elseif ($oldVal == 0 || $oldVal == '0' || is_null($oldVal)) {

                $newVal = '1';

            } else {

                return ['status' => 'error'];

            }

        }

        if (! empty(request()->action)) {

            try {
                $entyObj->{request()->action}();
            }
            catch (\Exception $e) {
                return ['status' => 'error'];
            }

        }

        $entyObj->{request()->property} = $newVal;
        $entyObj->save();

        return [
            'status' => 'success',
            'newVal' => $newVal
        ];

    }

}
