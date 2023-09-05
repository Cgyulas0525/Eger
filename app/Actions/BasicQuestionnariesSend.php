<?php

namespace App\Actions;

use App\services\QuestionnaireService;
use App\Actions\ClientQuestionnarieInsert;

class BasicQuestionnariesSend
{
    private $questionnaireService;
    private $clientQuestionnarieInsert;

    public function __construct() {
        $this->questionnaireService = new QuestionnaireService();
        $this->clientQuestionnarieInsert = new ClientQuestionnarieInsert();
    }

    public function handle($record) {
        $questionnaries = $this->questionnaireService->activeBasicQuestionnaries();
        if (!empty($questionnaries)) {
            foreach ($questionnaries as $questionnarie) {
                $this->clientQuestionnarieInsert->handle($record, $questionnarie);
            }
        }
    }

}

