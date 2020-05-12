<?php

namespace porcelanosa\widgets\toastr;

use yii\bootstrap4\Html;
use yii\helpers\Json;

class NotificationFlash extends NotificationBase
{
    /** @var object $session */
    private $session;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->session = \Yii::$app->session;

        $flashes = $this->session->getAllFlashes();

        foreach ($flashes as $type => $data) {
            $data = (array) $data;

            foreach ($data as $i => $message) {
                Notification::widget([
                    'type' => Html::encode($type),
                    'message' => Html::encode($message),
                    'options' => Json::decode((string) $this->options),
                ]);
            }

            $this->session->removeFlash($type);
        }
    }
}
