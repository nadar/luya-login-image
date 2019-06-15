<?php

namespace Nadar\LoginImage;

use Yii;
use yii\base\Event;
use yii\base\BootstrapInterface;
use luya\web\Application;
use luya\admin\controllers\LoginController;

/**
 * Login Bootstrap.
 * 
 * @author Basil Suter <basil@nadar.io>
 * @since 1.0.0
 */
class LoginImageBootstrap implements BootstrapInterface
{
    /**
     * (@inheritDoc)
     */
    public function bootstrap($app)
    {
        if ($app instanceof Application && Yii::$app->request->isAdmin) {
            Event::on(LoginController::class, LoginController::EVENT_BEFORE_ACTION, [$this, 'assignImagePath']);
        }
    }

    /**
     * Assigne the image to the view.
     *
     * @param Event $event
     * @return void
     */
    public function assignImagePath(Event $event)
    {
        $event->sender->backgroundImage = 'https://nadar.io/image/latest/'.time().'/'.sha1(Yii::$app->id);
    }
}