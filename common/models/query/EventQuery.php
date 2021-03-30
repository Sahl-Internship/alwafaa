<?php

namespace common\models\query;

use common\models\EventAttachment;
use Yii;

/**
 * This is the ActiveQuery class for [[\common\models\Event]].
 *
 * @see \common\models\Event
 */
class EventQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Event[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Event|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getAttachments($id)
    {
        $attached_files = EventAttachment::find()->andWhere('event_id=:id', ['id' => $id])->all();
        $attachments = [];
        foreach ($attached_files as $attached_file) {
            $file = Yii::getAlias($attached_file->base_url . '/' . $attached_file->path);
            array_push($attachments, $file);
        }
        return $attachments;
    }
}
