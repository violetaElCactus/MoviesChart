<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pelicula".
 *
 * @property int $ID
 * @property string $Nombre
 * @property string $Sinopsis
 * @property string $Trailer
 * @property string $Director
 * @property string $Imagen
 * @property string $Estreno
 */
class Pelicula extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelicula';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'Nombre', 'Sinopsis', 'Trailer', 'Director', 'Imagen', 'Estreno'], 'required'],
            [['ID'], 'integer'],
            [['Estreno'], 'safe'],
            [['Nombre', 'Trailer', 'Director', 'Imagen'], 'string', 'max' => 50],
            [['Sinopsis'], 'string', 'max' => 300],
            [['ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Nombre' => 'Nombre',
            'Sinopsis' => 'Sinopsis',
            'Trailer' => 'Trailer',
            'Director' => 'Director',
            'Imagen' => 'Imagen',
            'Estreno' => 'Estreno',
        ];
    }
}
