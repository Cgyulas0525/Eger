<?php

namespace App\Http\Controllers;

use App\Models\Settlements;
use Illuminate\Http\Request;
use App\Actions\ValidPostcodesInsert;
use App\Actions\PartnerQuestionnarieDelete;
use App\Models\Partnerquestionnaries;

class MyApiController extends Controller
{

    public static function insertValidPostcodesRecord(Request $request)
    {
        $s = Settlements::where('name', $request->get('settlement'))->first();
        $validpostcodesinsert = new ValidPostcodesInsert();
        foreach (Settlements::where('name', $request->get('settlement'))->get() as $settlemen) {
            $validpostcodesinsert->handle($s->id, $settlemen->postcode);
        }
    }

    /**
     * Partner attaching to the questionnarie
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function partnerAttachQuestionnarie(Request $request)
    {
        Partnerquestionnaries::withTrashed()->updateOrCreate(
            [
                'partner_id' => $request->get('partner'),
                'questionnarie_id' => $request->get('questionnaire'),
            ],
            [
                'deleted_at' => NULL,
                'updated_at' => now()->toDateTimeString(),
            ]
        )->restore();

        return back();
    }

    /**
     * Partner unhooking from the questionnarie
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function partnerUnhookQuestionnarie(Request $request)
    {
        (new PartnerQuestionnarieDelete())->handle($request->get('partner'), $request->get('questionnaire'));
        return back();
    }
}
