<?php

namespace App\Http\Controllers;

use App\Models\Settlements;
use Illuminate\Http\Request;
use DB;

use App\Actions\ValidPostcodesInsert;
use App\Actions\PartnerQuestionnarieInsert;
use App\Actions\PartnerQuestionnarieDelete;

class MyApiController extends Controller
{

    public static function insertValidPostcodesRecord(Request $request) {
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
    public static function partnerAttachQuestionnarie(Request $request) {

        $partnerQuestionnarie = DB::table('partnerquestionnaries')
                    ->where('partner_id', $request->get('partner'))
                    ->where('questionnarie_id', $request->get('questionnaire'))
                    ->first();

        if (!empty($partnerQuestionnarie)) {

            $pd = new PartnerQuestionnarieDelete();
            $pd->handle($request->get('partner'), $request->get('questionnaire'));

        } else {
            $partnerQuestionnarieInsert = new PartnerQuestionnarieInsert();
            $partnerQuestionnarieInsert->handle($request->get('partner'), $request->get('questionnaire'));
        }

        return back();
    }

    /**
     * Partner unhooking from the questionnarie
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function partnerUnhookQuestionnarie(Request $request) {

        $pd = new PartnerQuestionnarieDelete();
        $pd->handle($request->get('partner'), $request->get('questionnaire'));

        return back();
    }
}
