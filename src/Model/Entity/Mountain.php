<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mountain Entity
 *
 * @property int $id
 * @property int $mountain_no
 * @property string $mountain_name
 * @property string $area
 * @property string $elevation
 * @property string|null $difficulty_level
 * @property string|null $physical_level
 * @property int|null $schedule_type
 * @property string|null $active_volcano
 * @property string|null $snow_season
 * @property string|null $remaining_snow_season
 * @property string|null $climbing_season_type
 * @property string|null $autumn_season_type
 * @property \Cake\I18n\FrozenTime|null $created
 * @property int|null $created_by
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $modified_by
 */
class Mountain extends Entity
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
