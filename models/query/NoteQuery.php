<?php

namespace app\models\query;

use app\models\Note;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\Note]].
 *
 * @see \app\models\Note
 */
class NoteQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Note[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Note|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byUser($id)
    {
        return $this->andWhere(['created_by' => $id]);
    }
}
