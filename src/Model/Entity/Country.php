<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Country Entity.
 *
 * @property int $id
 * @property string $code
 * @property string $name_en
 * @property string $name_ara
 * @property float $latitude
 * @property float $longitude
 * @property string $title1_en
 * @property string $title1_ara
 * @property string $text1_en
 * @property string $text1_ara
 * @property string $title2_en
 * @property string $title2_ara
 * @property string $text2_en
 * @property string $text2_ara
 * @property string $title3_en
 * @property string $title3_ara
 * @property string $text3_en
 * @property string $text3_ara
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Country extends Entity
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
