<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicantLostMap Entity.
 *
 * @property int $id
 * @property int $lost_item_id
 * @property \App\Model\Entity\LostItem $lost_item
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $map_id
 * @property \App\Model\Entity\Map $map
 */
class ApplicantLostMap extends Entity
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
