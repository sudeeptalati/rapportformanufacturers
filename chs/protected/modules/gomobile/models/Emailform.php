<?php

/**
 * This is the model class for table "engineer_data".
 *
 * The followings are the available columns in table 'engineer_data':
 * @property integer $id
 * @property integer $engineer_id
 * @property string $data
 */
class Emailform extends CFormModel
{
    public $email_to;
    public $email_from;
    public $email_body;
    public $email_subject;



    public function rules()
    {
        return array(
            array('email_to, email_from,email_subject, email_body', 'required'),
            array('email_to, email_from ', 'email'),

           array('email_to, email_from, email_subject, email_body', 'safe'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'email_to' => 'To',
            'email_from' => 'Reply to',
            'email_subject' => 'Subject',
            'email_body' => 'Message',
        );
    }

}///end of class
