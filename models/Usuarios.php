<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $dni
 * @property string $password
 *
 * @property Reservas[] $reservas
 */
class Usuarios extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'dni', 'password'], 'required'],
            [['nombre', 'dni', 'password'], 'string', 'max' => 255],
            [['dni'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'dni' => 'Dni',
            'password' => 'Contraseña',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reservas::className(), ['usuario_id' => 'id']);
    }


    /*****************************    LOGIN   **************************/

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
    }

    /**
     * Compara si la cadena pasada como parámetro coincide con la
     * contraseña de este usuario.
     * @param  string $password La contraseña a validar.
     * @return bool             Devuelve true si es válida.
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword(
            $password,
            $this->password
        );
    }
}
