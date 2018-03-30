<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicantLostPicture Entity.
 *
 * @property int $id
 * @property int $lost_item_id
 * @property \App\Model\Entity\LostItem $lost_item
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $picture
 */
class ApplicantLostPicture extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}



/*
public function initialize(array $config) {
    $validator
       ->requirePresence('image_path', 'create')
       ->notEmpty('image_path')
       ->add('processImageUpload', 'custom', [
          'rule' => 'processImageUpload'
       ])
}

*/